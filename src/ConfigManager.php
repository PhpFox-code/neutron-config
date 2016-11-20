<?php

namespace Phpfox\Config;

/**
 * Class StandConfig
 *
 * @package Phpfox\Config
 */
class ConfigManager implements ConfigManagerInterface
{
    /**
     * @var ConfigManager
     */
    static private $singleton;

    protected $data = [];

    public static function instance()
    {
        if (null == self::$singleton) {
            self::$singleton = new static();
            self::$singleton->initialize();
        }
        return self::$singleton;
    }

    public function initialize()
    {
        $this->extend(include PHPFOX_DIR . '/config/library.config.php');
        $this->extend(include PHPFOX_DIR . '/config/db.config.php');
    }

    public function extend($data)
    {
        $this->data = array_merge_recursive($this->data, $data);
        return $this;
    }

    public function loadModularConfig()
    {
        $result = service('db')->sqlSelect()->from(':core_package')->select('*')
            ->where('is_active=?', 1)->order('is_core', 1)->order('priority', 1)
            ->execute();

        $result = $result->fetch();
        $data = [];
        foreach ($result as $row) {
            $configFilename = PHPFOX_DIR . '/' . $row->path
                . '/config/module.config.php';
            $data = array_merge_recursive($data, include $configFilename);
        }

        $autoloader = service('autoloader');
        foreach ($data['psr4'] as $k => $vs) {
            foreach ($vs as $v) {
                $autoloader->addPsr4($k, PHPFOX_DIR . DS . $v);
            }
        }

        $this->extend($data);

        events()->trigger('onApplicationConfigChanged', $this);

        return $this;
    }

    public function get($key)
    {
        if (strpos($key, '.')) {
            list($p0, $p1) = explode('.', $key, 2);
            if (!isset($this->data[$p0])) {
                return null;
            }
            if (!isset($this->data[$p0][$p1])) {
                return null;
            }

            return $this->data[$p0][$p1];
        }

        if (!isset($this->data[$key])) {
            return null;
        }
        return $this->data[$key];
    }


    public function set($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

}