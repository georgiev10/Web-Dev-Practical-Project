<?php

abstract class BaseController {
    protected $controllerName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;
    protected $isLoggedIn = false;
    protected $validationError;
    protected $formValues;
    protected $isAdmin = false;

    function __construct($controllerName){
        $this->controllerName = $controllerName;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }

        if (isset($_SESSION['username'])) {
            $this->isLoggedIn = true;
        }

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1){
            $this->isAdmin = true;
        }

        $this->onInit();
    }

    public function onInit(){
        //Implement initializing logic in the subclasses
    }

    public function index(){
        //Implement the default action in the subclasses
    }

    public function renderView($viewName = 'index', $includeLayout = true)
    {
        if (!$this->isViewRendered) {
            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            if ($includeLayout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once($headerFile);
            }
            include_once($viewFileName);
            if ($includeLayout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once($footerFile);
            }
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect($controllerName, $actionName = null, $params = null) {
        $url = '/' . urldecode($controllerName);
        if($actionName !=null){
            $url .= '/' . urldecode($actionName);
        }
        if($params !=null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    public function authorise(){
        if(!$this->isLoggedIn){
            $this->addErrorMessage('Please login first!');
            $this->redirect('user', 'login');
        }
    }

    public function administrate(){
        if(!$this->isAdmin){
            $this->addErrorMessage('Please login with administrative permission!');
            $this->redirect('user', 'login');
        }
    }

    public function addValidationError($field, $message){
    $this->validationError[$field] = $message;
}

    public function getValidationError($field){
        return $this->validationError[$field];
    }

    public function addFieldValue($field, $value){
        $this->formValues[$field] = $value;
    }

    public function getFieldValue($field){
        return $this->formValues[$field];
    }

    function addMessage($msg, $type) {
        if( !isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        array_push($_SESSION['messages'], array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }

}
