<?php

namespace App\Traits;

trait SetDatabase {
	
  public static function boot()
  {
      parent::boot();
      config(['audit.drivers.database' => [
          'table'       => 'audits',
          'connection'  => 'tenant'
      ]]);
  }
 
}