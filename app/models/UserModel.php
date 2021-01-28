<?php

class UserModel extends DataEntry{
    public function __construct(int $id = 0){
        if($id > 0){
            $this->select($id);
        }
    }

    public function select($uniqid = 0){
        if($uniqid <= 0) return false;
        $user = iDB::table('users')->find($uniqid, 'user_id');
        foreach($user as $key => $value){
            $this->set($key, $value);
        }
        return $this;
    }
}