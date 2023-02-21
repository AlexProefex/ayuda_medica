<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}


///sELECCIONAR TODAS LAS TABLAS CON CAMPOS MODOFICADOS
/*
set @names :=  
       information_schema.columns.table_name
from information_schema.columns 
join information_schema.tables  on information_schema.tables.table_schema = information_schema.columns.table_schema
                                   and information_schema.tables.table_name = information_schema.columns.table_name
                                   and information_schema.tables.table_type = 'BASE TABLE'
where col.data_type in ('timestamp')
      and information_schema.columns.table_schema not in ('information_schema', 'sys',
                                   'performance_schema', 'mysql')
     and information_schema.columns.table_schema = 'kiruv3'
     and information_schema.columns.column_name = 'updated_at'     
order by information_schema.columns.table_schema,
         information_schema.columns.table_name;
*/ 