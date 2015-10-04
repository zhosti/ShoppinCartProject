<?php

abstract class BaseController
{
    protected $controllerName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $user;
    protected $validationErrors;

    function __construct($controllerName)
    {
        $this->controllerName = $controllerName;
        $this->onInit();
    }

    public function onInit()
    {

    }

    public function index()
    {
        //Implement the dafault action in the subclasses
    }

    //to show views for current controller
    public function renderView($viewName = 'index', $includeLayout = true)
    {
        if (!$this->isViewRendered) {
            $viewFileName = 'views/' . $this->controllerName . '/' . $viewName . '.php';
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

    public function redirectToUrl($url){
        header("Location: ". $url);
        die;
    }

    public function redirect($controllerName, $actionName = null, $params = null){
        $url = '/' . urlencode($controllerName);
        if($actionName != null){
            $url .= '/' . $actionName;
        }
        if($params != null){
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }

        $this->redirectToUrl($url);
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    private function addMessage($msgSessionKey, $msgText){
        if(!isset($_SESSION[$msgSessionKey])){
            $_SESSION[$msgSessionKey] = [];
        }
        array_push($_SESSION[$msgSessionKey], $msgText);
    }

    protected function addErrorMessage($errorMsg) {
        $this->addMessage(ERROR_MESSAGES_SESSION_KEY, $errorMsg);
    }

    protected function addInfoMessage($infoMsg) {
        $this->addMessage(INFO_MESSAGES_SESSION_KEY, $infoMsg);
    }

    protected function isLoggedIn(){
        return isset($_SESSION['username']);
    }

    protected function isAdmin(){
        return isset($_SESSION['isAdmin']);
    }

    protected function isEditor(){
        return isset($_SESSION['isEditor']);
    }

    protected function authorize(){
        if(!$this->isLoggedIn()){
            $this->addErrorMessage("Please login first!");
            $this->redirect("account", "login");
        }
    }

    protected function addValidationError($field, $message){
        $this->validationErrors[$field] = $message;
    }

    public function getValidationError($field){
        return $this->validationErrors[$field];
    }

}