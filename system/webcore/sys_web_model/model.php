<?php
/**
 * Created by Alex Gavrilov.
 */

namespace sys\web;

use sys\pkg\config;
use system\lib\mongoDb;

class model
{
    protected $config;
    protected $db;

    public function __construct()
    {
        $this->config = config::getPackageConfig(__CLASS__);
        $this->db = $this->getMongoInstance();
    }

    /**
     *  Mongo instance, initialized default
     *
     * @return mongoDb
     */
    protected  function getMongoInstance()
    {
        static $mongo;
        if(!isset($mongo)) {
            $mongo = new mongoDb();
        }

        return $mongo;
    }




}