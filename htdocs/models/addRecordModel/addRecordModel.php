<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\model;

class addRecordModel
    extends model
{

    public function save($type, &$data)
    {
        return $this->{"save_{$type}"}($data);
    }

    private function save_bid($data)
    {
        $owner = $this->buildOwner($data['clientInfo']);
        $ownerId = $this->save('owner', $owner);

        $order = $this->buildOrder($data['orderInfo'], $ownerId);
        var_dump('order is', $order);
        $this->save('order', $order);
    }

    private function save_owner($ownerData)
    {
        if($ownerData['owner_id']) {
            $this->db->update(
                $this->config['clientsSection'],
                ['owner_id' => $ownerData['owner_id']],
                $ownerData,
                ['upsert' => true]
            );

            return $ownerData['owner_id'];
        }

        return false;
    }

    private function save_order(&$order)
    {
        $this->db->insert($this->config['ordersSection'], $order);
    }

    private function getOwnerId(&$data)
    {
        return md5($data['phone'] . $data['fio']);
    }

    private function buildOrder(&$data, &$ownerId)
    {
        $data['owner_id'] = $ownerId;
        $data['date'] = strtotime('now');

        return $data;
    }

    private function buildOwner(&$data)
    {
        $ownerId = $this->getOwnerId($data);

        return [
          'fio' => $data['fio'],
          'phone' => $data['phone'],
          'geo' => $data['address'],
          'desc_info' => $data['description'],
          'owner_id' => $ownerId
        ];
    }

}