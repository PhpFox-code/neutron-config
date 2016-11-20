<?php
namespace Phpfox\Config;

/**
 * Interface ConfigInterface
 *
 * @package Phpfox\Config
 */
interface ConfigManagerInterface
{
    /**
     * Extend configure using merge recursive
     *
     * @param array $data
     *
     * @return $this
     */
    public function extend($data);

    /**
     * if string is contain "dot", it search to child item.
     * maximum support is 2 level.
     *
     * $config->get('db.drivers')
     *
     * Get $data['db']['drivers']
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param string $key
     * @param array  $data
     *
     * @return $this
     */
    public function set($key, $data);
}