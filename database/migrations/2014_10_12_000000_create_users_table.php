<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    
    //App/Userにすれば正常に作動するs
   /* User::create([
      'name' =>"森本",       
      'email' => "morimoto@tech.com",
      'password' => Hash::make("pass"),
       ]);
       */
    }
    
    
    public function down()
    {
        Schema::dropIfExists('users'); 
    }
    
   
 }
