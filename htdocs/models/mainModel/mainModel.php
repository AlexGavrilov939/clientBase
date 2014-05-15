<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\model;

class mainModel
    extends model
{

    public static function factory()
    {
        static $modelInstance;
        if(!isset($modelInstance)) {
            $modelInstance = new self;
        }

        return $modelInstance;
    }

    public function getOrdersList()
    {
        $cursor = $this->db->select($this->config['ordersSection'], [], ['_id' => false]);
        $orders = [];

        while($cursor->hasNext()) {
            $order = $cursor->getNext();
            $owner = $this->getOwnerById($order['owner_id']);
            $this->getHumanDate($order['date']);
            $order['date'] = gmdate("Y.m.d H:i:s", $order['date']);
            $fullOrder = array_merge($owner, $order);
//            $order['owner'] = $owner;
            $orders[] = $fullOrder;
        }

        return $orders;
    }

    private function getHumanDate(&$timestamp)
    {
        return gmdate("Y.m.d H:i:s", $timestamp);
    }

    private function getOwnerById(&$id)
    {
       return $this->db->select(
           $this->config['clientsSection'],
           ['owner_id' => $id],
           ['_id' => false, 'owner_id' => false]
       )->getNext();
    }
}