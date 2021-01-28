<?php 
/**
 * Dashboard Controller
 */

class DashboardController extends Controller {
    function __construct($data = []){
    }
    public function process(){
        $View = view(VIEW_PATH.'/admin/index.php', $this->variables);
        $View->render();
    }
}