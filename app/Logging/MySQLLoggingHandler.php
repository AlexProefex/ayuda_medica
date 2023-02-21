<?php
namespace App\Logging;
// use Illuminate\Log\Logger;
use DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
class MySQLLoggingHandler extends AbstractProcessingHandler{
/*
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->table = 'logs';
        parent::__construct($level, $bubble);
    }
    protected function write(array $paramenter):void
    {
       // dd($paramenter); 
       //$input = json_encode($paramenter['context']);
       //dd($paramenter['context']['title']);
       $data = array(
           //'message'       => $paramenter['message'],
           'element'       => $paramenter['context']['title'],
           'message'       => $paramenter['context']['message'],
          // 'context'       => json_encode($paramenter['context']),
          // 'level'         => $paramenter['level'],
          //'level_name'    => $paramenter['level_name'],
          //'channel'       => $paramenter['channel'],
          //'paramenter_datetime' => $paramenter['datetime']->format('Y-m-d H:i:s'),
          // 'extra'         => json_encode($paramenter['extra']),
           'formatted'     => $paramenter['formatted'],
           'remote_addr'   => $_SERVER['REMOTE_ADDR'],
           'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
           'created_at'    => date("Y-m-d H:i:s"),
       );
       DB::connection()->table($this->table)->insert($data);     
    }
*/}