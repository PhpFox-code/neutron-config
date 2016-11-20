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