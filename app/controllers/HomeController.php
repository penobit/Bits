<?php

class HomeController extends Controller{
    function __construct(){
        $this->options = $this->model('Options');
    }

    /**
     * Get site title
     */
    public function getTitle(){
        return $this->options->get('siteTitle');
    }

    function process(){ 
        $templatePath = activeTemplate('path');
        $homeFile = sprintf('%s/%s', $templatePath, 'index.php');
        
        if(!file_exists($homeFile)){
            global $iLite;
            return $iLite->notFound();
        }
        
        $View = $this->view($homeFile, $this->variables);
        $View->setTitle($this->getTitle());
        $View->render();
    }
}