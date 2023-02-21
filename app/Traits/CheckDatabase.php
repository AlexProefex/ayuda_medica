<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait CheckDatabase {
	

  public function checkCurrentDatabase($domain){
    $database = 'kiru_'.Str::lower($domain);
   // DB::connection('tenant')->statement("DROP IF EXISTS DATABASE {$database};");
    //DB::connection('tenant')->statement("CREATE DATABASE {$database};");

    DB::statement("DROP DATABASE IF EXISTS `{$database}`;");

  }
}