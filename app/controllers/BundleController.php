<?php
class BundleController extends Controller{
    protected $params;
    protected $bundleID;

    public function process(){
        [
            'type' => $type,
            'id' => $id
        ] = $this->getVariable('route')->params;

        Header::$type();
        $bundle = $this->model('Bundle', $id);
        $bundle->output($type);

        return $this;
    }
}