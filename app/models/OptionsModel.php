<?php

class OptionsModel{
    protected $options;
    
    function __construct(){
        $this->cacheFile = APP_PATH.'/options.iLite';
        $this->loadOptionsFromCache();
    }

    /**
     * Load options from cache file
     */
    public function loadOptionsFromCache(){
        $contents = file_get_contents($this->cacheFile);

        if(!empty($contents)){
            $options = @unserialize($contents);
            $this->options = $options;
        }else{
            $this->cacheOptions()->loadOptionsFromCache();
        }

        return $this;
    }

    /**
     * Load options from database
     */
    public function loadOptions(){
        $optionsData = iDB::table('options')->select('*')->get();
        $options = [];

        foreach($optionsData as $opt) $options[$opt->option_name] = $opt->option_value;
        $this->options = $options;

        return $this;
    }

    /**
     * get serialized options (for caching)
     */
    public function getSerializedOptions(){
        if(empty($options)){
            $this->loadOptions();
        }

        return serialize($this->options);
    }

    /**
     * cache options to cache file
     */
    public function cacheOptions(){
        $this->loadOptions();
        file_put_contents($this->cacheFile, $this->getSerializedOptions());
        
        return $this;
    }

    /**
     * get specific option value
     * @param string $option option's name
     */
    public function get(string $option){
        $value = $this->options[$option] ?? null;
        if($unserialized = @unserialize($value)){
            $value = $unserialized;
        }

        return $value;
    }

    /**
     * update option value in databse, cache and options object
     * @param string $option option's name
     * @param mixed $value option's value
     */
    public function set(string $option, $value){
        if(is_array($value) || is_object($value)){
            $value = serialize($value);
        }

        if(iDB::table('options')->where('option_name', $option)->count() > 0){
            iDB::table('options')->where('option_name', $option)->update(['option_value' => $value]);
        }else{
            iDB::table('options')->insert(['option_name' => $option, 'option_value' => $value]);
        }

        $this->loadOptionsFromCache();

        return $this;
    }

    /**
     * Remove an option
     * @param string $option option's name
     */
    public function delete(string $option){
        iDB::table('options')->where('option_name', $option)->delete();
        
        return $this;
    }

    /**
     * delete function's alias
     * @param string $option option's name
     */
    public function remove(string $option){
        return $this->delete($option);
    }
}