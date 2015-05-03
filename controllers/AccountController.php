<?php

class AccountController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new AccountModel();
    }

    public function register(){
        if($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($username == null || strlen($username) < 3) {
                $this->addErrorMessage('Username is invalid!');
                $this->redirect('account', 'register');
            }
            if($password == null || strlen($password) < 3) {
                $this->addErrorMessage('Password is invalid!');
                $this->redirect('account', 'register');
            }

            $isRegistered = $this->db->register($username, $password);
            if($isRegistered){
                $_SESSION['username'] = $username;
                $this->addInfoMessage('Successful registration.');
                $this->redirect('books', 'index');
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
                return $this->redirect('books', 'index');
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