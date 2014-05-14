<?php
/**
 * Created by Alex Gavrilov.
 */

use sys\web\model;

class loginModel
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

    public function checkAccountData($login, $password)
    {
        $account = $this->db->selectOne($this->config['usersSection'], ['login' => $login]);
        if(!is_null($account) && md5(md5($password)) == $account['password']) {
            return true;
        }
        return false;
    }

    public function updateUserAccount($login, $hash)
    {
        try {
            $this->db->update($this->config['usersSection'], ['login' => $login], ['$set' => ['userId' => $hash]]);
        } catch(Exception $e) {
            echo "Error (File: ".$e->getFile().", line ".
                $e->getLine()."): ".$e->getMessage();
        }

    }

    public function checkUserByHash($hash)
    {
        $test = $this->db->selectOne($this->config['usersSection'], ['userId' => $hash]);
        if(!is_null($this->db->selectOne($this->config['usersSection'], ['userId' => $hash]))) {
            return true;
        }
        return false;
    }

    public function getClientBases()
    {
       return $this->db->getCollectionNames(['users']);
    }

    public function createCollection($collectionName)
    {
        $this->db->createCollection($collectionName);
    }

    public function removeCollection($collectionName)
    {
        $this->db->removeCollection($collectionName);
    }




}