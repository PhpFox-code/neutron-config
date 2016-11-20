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
     *
     * @return mixed|null
     */
    function config($key)
    {
        return ConfigManager::instance()->get($key);
    }
}