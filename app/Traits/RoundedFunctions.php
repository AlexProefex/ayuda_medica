<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait RoundedFunctions {
	
	//Redonder los numeros a dos decimales 
	public function twoDecimal($value){
		return round(floatval($value),2,PHP_ROUND_HALF_UP);
	}

}