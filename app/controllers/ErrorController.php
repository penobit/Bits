<?php

class ErrorController extends Controller{
    function __construct(array $options = []){
        foreach($options as $opt => $val)
            $this->setVariable($opt, $val);
    }

    function process(){
        $this->view(VIEW_PATH.'/admin/error.php')->render();
    }
}