<?php

namespace system\lib;

use sys\debug\log;
use sys\pkg\config;

class cache
{

    protected static $instances = [];
    private $backend;

    public static function factory($configSection = 'default')
    {
        if(!isset(self::$instances[$configSection])) {
            self::$instances[$configSection] = new self($configSection);
        }

        return self::$instances[$configSection];
    }

    public function __construct($configSection)
    {
        $config = config::getPackageConfig(__CLASS__)[$configSection];
        var_dump('config is', $config);
        $driver = config::getClassName($config['driver']);
        var_dump('driver is', $driver);
        $this->backend = new $driver($config['config_section']);
        var_dump('backend is', $this->backend);

    }

    public function set($key, $value, $expire = 3600)
    {
        return $this->backend->set($key, $value, $expire);
    }

    public function add($key, $value, $expire = 3600)
    {
        return $this->backend->add($key, $value, $expire);
    }

    public function get($key)
    {
        return $this->backend->get($key);
    }

    public function exists($key)
    {
        $exists = $this->backend->exists($key);
        return $exists;
    }

    public function remove($key)
    {
        return $this->backend->remove($key);
    }

    public function clear()
    {
        log::put("WARNING! CLEARING ALL CACHE!", config::getPackageName(__CLASS__));
        return $this->backend->clear();
    }

    public function enableAutoCommit()
    {
        log::put("Transaction - autoCommit enabled", config::getPackageName(__CLASS__));
        return $this->backend->enableAutoCommit();
    }

    public function disableAutoCommit()
    {
        log::put("Transaction - autoCommit disabled", config::getPackageName(__CLASS__));
        return $this->backend->disableAutoCommit();
    }

    public function commit()
    {
        log::put("Transaction - Commiting...", config::getPackageName(__CLASS__));
        return $this->backend->commit();
    }
}