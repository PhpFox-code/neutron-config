<?php

namespace {

    use Phpfox\Config\ConfigManager;

    /**
     * @return ConfigManager
     */
    function configs()
    {
        return ConfigManager::instance();
    }

    /**
     * @param string $key
     * @param string $item
     *
     * @return mixed|null
     */
    function config($key, $item = null)
    {
        return ConfigManager::instance()->get($key, $item);
    }
}