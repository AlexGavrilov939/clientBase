<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\model;

class addRecordModel
    extends model
{
    public function test()
    {
        echo 'test';
    }

    public function processingClient($data)
    {
        $this->db->insert('clients', $data);
    }

    public function processingOrder($data)
    {
        $this->db->insert('orders', $data);
    }
}