<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        //delimiter //
        //;//  delimiter ;
        /*
        DB::unprepared('
        CREATE TRIGGER idVenta 
            BEFORE INSERT ON sales
               FOR EACH ROW
               BEGIN
                     DECLARE x INT;
                      SET x = (SELECT IFNULL(MAX(numero),0) FROM sales);
                   IF x = 0 THEN
                       SET NEW.numero = 1;
                   ELSE 
                       SET NEW.numero = x+1;
                   END IF;
               END');
    
    
    DB::unprepared(/*'
    CREATE FUNCTION idVenta() RETURNS trigger AS $idVenta$
    BEGIN
        DECLARE x INT;
        SET x = (SELECT coalesce(MAX(numero),0) FROM sales);
        IF x = 0 THEN
            SET NEW.numero = 1;
        ELSE 
            SET NEW.numero = x+1;
        END IF;
    END');
//$emp_stamp$ LANGUAGE plpgsql;
    DB::unprepared('
    CREATE TRIGGER idVenta BEFORE INSERT ON sales
    FOR EACH ROW EXECUTE FUNCTION idVenta()');
*/}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {/*
       DB::unprepared('DROP TRIGGER "idVenta"');
    */    }
};
