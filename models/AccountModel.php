<?php

class AccountModel extends BaseModel {

    public function register($username, $password){
        $statement = self::$db->prepare('SELECT COUNT(Id) FROM users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(Id)']) {
            return false;
        }
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        $registerStatement = self::$db->prepare('INSERT INTO users (username, pass_hash) VALUES (?, ?)');
        $registerStatement->bind_param('ss', $username, $hash_pass);
        $registerStatement->execute();

        return true;
    }

    public function login($username, $password){
        $statement = self::$db->prepare('SELECT Id, username, pass_hash FROM users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        $password_check =  password_verify($password, $result['pass_hash']);
        if($password_check){
            return true;
        }

        return false;
    }

}