<?php
use sys\pkg\config;
use sys\web\controller;
use system\lib\excel;

/**
 * Created by Alex Gavrilov.
 */
class Main
    extends controller
{


    public function index()
    {
        var_dump($_COOKIE);
        $test = $this->getOrdersList();
        var_dump($test);
        $data['test'] = 'test';
        $data['orders'] = $this->getOrdersList();
        $data['content'] = $this->parser()->loadView('dashboard', $data['orders']);
        $this->parser()->parse('template', $data);
    }

    protected function getOrdersList()
    {
        $cursor =  $this->mongoDb()->select('orders');
        $result = [];
        while($cursor->hasNext())
        {
            $result[] = $cursor->getNext();
        }
        return $result;
    }

    protected function mongoDb()
    {
        static $instance;
        if(!isset($instance)) {
            $instance = \system\lib\mongoDB::factory();
            $collection = $instance->getDatabase()->selectCollection('orders');
            $indexes = $collection->getIndexInfo();
            if(count($indexes) < 2) {
                $collection->ensureIndex(['id' => ""], ['unique' => true]);
            }
        }
        return $instance;
    }
}