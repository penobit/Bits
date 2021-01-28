<?php 
/**
 * Log class
 * Read and Write log files
 * @author Penobit<info@penobit.com>
 * @link https://iLite.ir
 * @link https://penobit.com
 * @link https://github.com/penobit/ilite
 * @version 1.0
 */

class Log{
    protected $logFile;
    protected $logs;
    protected $handler;

    /**
     * instantiate class
     * 
     * @param string $logFile if set logs will be loaded from $logFile path if file doesn't exists it will be created
     */
    function __construct(string $logFile = null){
        if(isset($logFile)){
            $this->load($logFile);
        }
    }

    /**
     * load logs from log file
     * 
     * @param string $file log file path
     */
    public function load(string $file){
        $path = sprintf('%s/%s.log', LOG_PATH, $file);
        $handle = fopen($path, 'a+');

        $this->setLogFile($path)->setLogFileHandle($handle)->loadLogs();

        return $this;
    }

    /**
     * sets file handler that is got from fopen
     * 
     * @param resource $handler file handler
     */
    public function setLogFileHandle($handler){
        $this->handler = $handler;
        return $this;
    }

    /**
     * get file handler
     */
    public function getLogFileHandle(){
        return $this->handler ?? null;
    }

    /**
     * get log file path
     */
    public function getLogFile(){
        return $this->logFile ?? null;
    }

    /**
     * set log file path
     * 
     * @param string $filePath log file path
     */
    public function setLogFile(string $filePath){
        $this->logFile = $filePath;
        return $this;
    }

    /**
     * get logs
     * 
     * @param int $limit logs limit
     * @param int $page logs offset ($limit * $page)
     */
    public function getLogs(int $limit = null, int $page = 1){
        $logs = $this->logs;
        if(isset($limit)){
            if($page < 1) $page = 1;
            $logs = array_splice($logs, ($page - 1) * $limit, $limit);
        }

        return $logs;
    }

    /**
     * set logs
     * 
     * @param array $logs array that contains logs objects
     */
    public function setLogs(array $logs){
        $this->logs = $logs;
        return $this;
    }

    /**
     * parse log string into object
     * 
     * @param string $logString log string to parse
     */
    public function parse(string $logString){
        $logData = explode("\n", $logString);
        $logData = array_filter($logData);

        foreach($logData as $data){
            [$key, $value] = explode(':', $data, 2);
            $key = trim($key);
            $value = trim($value);
            if(empty($key)) return;
            $log[$key] = $value;
        }

        return (object)$log;
    }

    /**
     * load logs from file
     */
    public function loadLogs(){
        if(empty($this->getLogFile())) return;
        $lines = file($this->getLogFile());
        $log = '';
        $logs = [];
        foreach($lines as $line){
            $line = trim($line);
            if(empty($line)){
                $logs[] = $this->parse($log);
                $log = '';
                continue;
            }
            $log .= $line."\n";
        }

        $this->setLogs($logs);
        return $this;
    }

    /**
     * add log to log file
     * 
     * @param string|array|object $log new log object
     */
    public function addLog($log){
        if(is_string($log)){
            $log = $this->parse($log);
        }else{
            $log = (object)$log;
        }

        if(empty($log->id)){
            $log->id = uniqid();
        }

        $data = $log;
        $log = [];
        
        foreach($data as $key => $value){
            $log[] = sprintf('%s: %s', $key, $value);
        }
        
        fwrite($this->getLogFileHandle(), join("\n", $log)."\n\n");
        $this->loadLogs();

        return $this;
    }

    /**
     * clear current logs from log file
     */
    public function clear(){
        $this->setLogs([]);
        $this->save();
        return $this;
    }

    /**
     * save current logs to log file
     */
    public function save(){
        $logs = $this->getLogs();
        $contents = '';

        foreach($logs as $log){
            $line = '';
            foreach($log as $key => $value) $line .= sprintf('%s: %s', $key, $value);
            $contents .= $line;
        }

        if(empty(trim($contents)))$contents = '';

        file_put_contents($this->getLogFile(), $contents);
        $this->loadLogs();
        return $this;
    }
}