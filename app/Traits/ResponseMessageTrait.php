<?php

namespace App\Traits;

trait ResponseMessageTrait {
	
	//Redonder los numeros a dos decimales 
	public function responseMessageBody($status,$title,$message=null){
		$res = app()->make('stdClass');
		$res->status = $status;
		$res->title = $title;
		$res->message = $message;
		return $res;
	}

}