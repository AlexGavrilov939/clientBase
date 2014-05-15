<?php

namespace system\cache;

use sys\pkg\config;
use system\lib\cache;

class memcached
    extends cache
{

    protected $memcached;

    public function commit()
    {
        throw new \Exception("Transactions not implemented in package " . config::getPackageName(__CLASS__));
    }

    public function enableAutoCommit()
    {
        throw new \Exception("Transactions not implemented in package " . config::getPackageName(__CLASS__));
    }

    public function disableAutoCommit()
    {
        throw new \Exception("Transactions not implemented in package " . config::getPackageName(__CLASS__));
    }

    public function __construct($configSection = 'default')
    {
        $config = config::getPackageConfig(__CLASS__)[$configSection];
        $this->memcached = new \Memcached();
        foreach($config['servers'] as $server) {
            $this->memcached->addServer($server['host'], $server['port']);
        }
    }

    public function set($key, $value, $expire = 60)
    {
        return $this->memcached->set($key, $value, $expire);
    }

    public function add($key, $value, $expire = 60)
    {
        return $this->memcached->add($key, $value, $expire);
    }

    public function get($key)
    {
        return $this->memcached->get($key);
    }

    public function exists($key)
    {
        $data = $this->memcached->get($key);
        return !($data === false || $data === null);
    }

    public function remove($key)
    {
        return $this->memcached->delete($key);
    }

    public function clear()
    {
        return $this->memcached->flush();
    }
}