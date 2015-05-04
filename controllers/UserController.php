<?php

class UserController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new UserModel();
    }

    public function register(){
        if($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if($username == null || strlen($username) < 3) {
                $this->addErrorMessage('Username is invalid!');
                $this->redirect('user', 'register');
            }
            if($password == null || strlen($password) < 3) {
                $this->addErrorMessage('Password is invalid!');
                $this->redirect('user', 'register');
            }
            if($email == null || strlen($email) < 8) {
                $this->addErrorMessage('Email is invalid!');
                $this->redirect('user', 'register');
            }

            $isRegistered = $this->db->register($username, $password, $email);
            if($isRegistered){
                $_SESSION['username'] = $username;
                $this->addInfoMessage('Successful registration.');
                $this->redirect('home', 'index');
            }else{
                $this->addErrorMessage('Register failed!');
            }
        }
        $this->renderView('register');
    }

    public function login(){
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLoggedIn = $this->db->login($username, $password);
            if($isLoggedIn) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage('Successful login.');
                return $this->redirect('home', 'index');
            }
            else{
                $this->addErrorMessage('Login error!');
            }
        }
        $this->renderView('login');
    }

    public function logout(){
        $this->authorise();
        unset($_SESSION['username']);
        $this->addInfoMessage('Successful logout.');
        $this->redirect('home', 'index');
    }

}