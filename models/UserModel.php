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
        $registerStatement = self::$db->prepare('
          INSERT INTO users (username, passwordHash, email)
          VALUES (?, ?, ?)
          ');
        $registerStatement->bind_param('sss', $username, $hash_pass, $email);
        $registerStatement->execute();

        return  self::$db->insert_id;
    }

    public function login($username, $password){
        $statement = self::$db->prepare('
          SELECT Id, username, passwordHash, is_admin
          FROM users WHERE username = ?'
        );
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        $password_check =  password_verify($password, $result['passwordHash']);
        if($password_check){
            return $result;
        }

        return false;
    }

    public function getUserProfile($username){
        $statement = self::$db->prepare('
          SELECT id, username, email, is_admin
          FROM users
          WHERE username = ?'
        );
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function editByAdmin($id, $newUsername, $newEmail, $isAdmin){
        $statement = self::$db->prepare(
            "UPDATE users SET username=?, email=?, is_admin=? WHERE id=?");
        $statement->bind_param("ssii", $newUsername, $newEmail, $isAdmin, $id);
        $statement->execute();

        if( $statement->affected_rows > 0){
            $statement = self::$db->prepare("SELECT username, is_admin FROM users WHERE id=?");
            $statement->bind_param("i", $id);
            $statement->execute();
            $result = $statement->get_result()->fetch_assoc();
            return $result;
        }else{
            return false;
        }
    }

    public function checkNewUsername($newUsername) {
        $statement = self::$db->prepare('SELECT id FROM users WHERE username = ?');
        $statement->bind_param('s', $newUsername);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result;
    }

    public function editByUser($id, $newEmail){
        $statement = self::$db->prepare("UPDATE users SET email=? WHERE id=?");
        $statement->bind_param("si", $newEmail, $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function changePass($password, $id){
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);
        $statement = self::$db->prepare("UPDATE users SET passwordHash=? WHERE id=?");
        $statement->bind_param("si", $hash_pass, $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

}