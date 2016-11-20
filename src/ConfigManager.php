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

    }

    public function extend($data)
    {
        $this->data = array_merge_recursive($this->data, $data);
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
            return $this->data[$key];
        }
    }


    public function set($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }

}