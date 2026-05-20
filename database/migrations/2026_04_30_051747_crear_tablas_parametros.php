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
    {
        Schema::create('almacen', function(Blueprint $table){
            $table->increments('id');  
            $table->string('codigo',4)->unique();    
            $table->string('descripcion',64);         
            $table->string('estado',1);         
            
            $table->timestamps();  
        });

        Schema::create('motivo_ingreso', function(Blueprint $table){
            $table->increments('id');  
            $table->string('descripcion',128);
            $table->string('obsv',64)->nullable();
            $table->string('estado',1);         
            $table->timestamps();       
        });

        Schema::create('motivo_salida', function(Blueprint $table){
            $table->increments('id');  
            $table->string('descripcion',128);
            $table->string('obsv',64)->nullable();
            $table->string('estado',1);         
            $table->timestamps();       
        });

        Schema::create('proveedor', function(Blueprint $table){
            $table->increments('id');  
            $table->string('codigo',8)->unique();
            $table->string('razon_social',150);    
            $table->string('nit',10)->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('direccion',150)->nullable();    
            $table->string('tipo_prov',1); 
            $table->string('contacto',64)->nullable();
            $table->integer('celular')->nullable();
            $table->string('email_cont',64)->nullable();
            $table->string('email_prov',64)->nullable();
            $table->string('obsv',150)->nullable();   
            $table->string('estado',1);         
            $table->timestamps();       
        });

        Schema::create('tipo_producto', function(Blueprint $table){
            $table->increments('id');  
            $table->string('codigo',4)->unique();
            $table->string('descripcion',45);    
            $table->string('estado',1);         
            $table->timestamps();       
        });

        Schema::create('unidad_medida', function(Blueprint $table){
            $table->increments('id');  
            $table->string('codigo',4)->unique();     
            $table->string('descripcion',45);   
            $table->string('abreviatura',8);    
            $table->string('estado',1);        
            $table->timestamps();       
        });

        Schema::create('producto', function(Blueprint $table){ 
            $table->increments('id');   
            $table->string('codigo',8)->unique();                 
            $table->string('descripcion',45);       
            $table->integer('FK_id_tipo_producto')->unsigned();           
            $table->integer('FK_id_unidad')->unsigned();             
            $table->string('estado',1);                 
 
            $table->foreign('FK_id_tipo_producto')->references('id')->on('tipo_producto');  
            $table->foreign('FK_id_unidad')->references('id')->on('unidad_medida');    
            $table->timestamps();      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
        Schema::dropIfExists('unidad_medida');
        Schema::dropIfExists('tipo_producto');
        Schema::dropIfExists('proveedor');
        Schema::dropIfExists('motivo_salida');
        Schema::dropIfExists('motivo_ingreso');
        Schema::dropIfExists('almacen');
    }
};
