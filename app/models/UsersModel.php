<?php

class UsersModel extends DataCollection{
    public function __construct(int $id = 0){
        $this->setQuery(iDB::table('users'));
    }
}