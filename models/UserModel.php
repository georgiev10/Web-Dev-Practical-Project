<?php

class UserModel extends BaseModel {

    public function register($username, $password, $email){
        $statement = self::$db->prepare('SELECT COUNT(Id) FROM users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        if($result['COUNT(Id)']) {
            return false;
        }
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        $registerStatement = self::$db->prepare('INSERT INTO users (username, passwordHash, email) VALUES (?, ?, ?)');
        $registerStatement->bind_param('sss', $username, $hash_pass, $email);
        $registerStatement->execute();

        return true;
    }

    public function login($username, $password){
        $statement = self::$db->prepare('SELECT Id, username, passwordHash, is_admin FROM users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        $password_check =  password_verify($password, $result['passwordHash']);
        if($password_check){
            return $result;
        }

        return false;
    }

    public function getUserId($username) {
        $statement = self::$db->prepare('SELECT id FROM users WHERE username = ?');
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }
}