<?php 
/**
 * Authenticate Controller
 */

class AuthController extends Controller {
    function __construct($data = []){
    }
    public function process(){
        $params = $this->getVariable('route')->params;
        $file = $params['action'];
        if(!in_array($file, ['login', 'register', 'forget-password', 'reset-password'])){
            $file = 'login';
        }
        $file = sprintf('%s/admin/%s.php', VIEW_PATH, $file);
        $View = view($file, $this->variables);
        $View->render();
    }
}