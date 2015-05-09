<?php

class UserController extends BaseController {
    private $db;

    public function onInit() {
        $this->db = new UserModel();
        $this->dbTags = new TagsModel();
        $this->tagSidebar = $this->dbTags->getPopularTags();
    }

    public function register(){
        $this->title = "Register";
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

            $isRegisteredId = $this->db->register($username, $password, $email);
            if($isRegisteredId){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $isRegisteredId;
                $this->addInfoMessage('Successful registration.');
                $this->redirect('home', 'index');
            }else{
                $this->addErrorMessage('Register failed!');
            }
        }
        $this->renderView('register');
    }

    public function login(){
        $this->title = "Login";
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = $this->db->login($username, $password);
            if($result) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $result['Id'];
                $_SESSION['isAdmin'] = $result['is_admin'];
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
        unset($_SESSION['isAdmin']);
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        unset($_SESSION['post']);
        unset($_SESSION['tags']);
        unset($_SESSION['comments']);
        unset($_SESSION['userProfile']);
        $this->addInfoMessage('Successful logout.');
        $this->redirect('home', 'index');
    }

    public function profile($username){
        $this->authorise();
        $this->title = "User Profile";
        $this->userProfile = $this->db->getUserProfile($username);
        $_SESSION['userProfile'] = $this->userProfile;
        $this->renderView('profile');
    }


    public function editConfirm($username){
        $this->title = "Edit Profile";
        if(!$this->isAdmin && $username != $_SESSION['username']){
            $this->redirectToUrl('/');
        };
        $this->renderView('edit');
    }

    public function edit(){
        if($this->isPost){
            if($this->isAdmin){
                $this->editByAdmin();
            }else{
                $this->editByUser();
            }
        }
    }

    function editByAdmin(){
        $id = $_POST['user_id'];
        $username = $_POST['username'];
        $newUsername = $_POST['newUsername'];
        $newEmail = $_POST['email'];
        $isAdmin = $_POST['isAdmin'];
        $this->checkNewUsername($newUsername, $username, $id);
        if($newUsername == null || strlen($newUsername) < 3) {
            $this->addErrorMessage('Username is invalid!');
            $this->redirectToUrl('/user/profile/' . $username);
        }
        if($newEmail == null || strlen($newEmail) < 8) {
            $this->addErrorMessage('Email is invalid!');
            $this->redirectToUrl('/user/profile/' . $username);
        }
        $result = $this->db->editByAdmin($id, $newUsername, $newEmail, $isAdmin);
        if($result){
            //When admin change your own profile
            if($_SESSION['username']==$_POST['username']) {
                $_SESSION['username'] = $result['username'];
                $_SESSION['isAdmin'] = $result['is_admin'];
            }
            $this->addInfoMessage('Successful edit profile.');
            $this->redirectToUrl('/user/profile/' . $newUsername);
        }else{
            $this->addErrorMessage('Failed edit profile!');
            $this->redirectToUrl('/user/editConfirm/' . $username);
        }
    }

    function checkNewUsername($newUsername, $username, $user_id){
        $result = $this->db->checkNewUsername($newUsername);
        if($result['id'] == $user_id || $result == null){
            return true;
        }else{
            $this->addErrorMessage('Username is occupied!');
            $this->redirectToUrl('/user/editConfirm/' . $username);
        }
    }

    public function editByUser(){
        $id = $_POST['user_id'];
        $newEmail = $_POST['email'];
        $result = $this->db->editByUser($id, $newEmail);
        if($result){
            $this->addInfoMessage('Successful edit profile.');
            $this->redirectToUrl('/user/profile/' . $_SESSION['username']);
        }else{
            $this->addErrorMessage('Failed edit profile!');
            $this->redirectToUrl('/user/editConfirm/' . $_SESSION['username']);
        }
    }

    public function changePassConfirm(){
        $this->authorise();
        $this->title = "Edit Profile";
        $this->renderView('changePass');
    }

    public function changePass(){
        $this->authorise();
        if($this->isPost){
            $id = $_POST['user_id'];
            $password = $_POST['new-password'];
            $repeatedPassword = $_POST['repeat-new-password'];
            if($password == null || strlen($password) < 3) {
                $this->addErrorMessage('Password is invalid!');
                $this->redirectToUrl('/user/changePassConfirm');
            }
            if($password != $repeatedPassword) {
                $this->addErrorMessage('Repeated password is different!');
                $this->redirectToUrl('/user/changePassConfirm');
            }
            $isChangedPass = $this->db->changePass($password, $id);
            if($isChangedPass){
                $this->addInfoMessage('Successful password changed.');
                $this->redirectToUrl('/user/profile/' . $_SESSION['username']);
            }else{
                $this->addErrorMessage('Failed password changed!');
                $this->redirectToUrl('/user/changePassConfirm');
            }
        }
    }


}