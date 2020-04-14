<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historyprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('profile_id');
            //この２つを書くことによってそれぞれnewsモデルと、profileモデルに関連づけができてる（外部キー）
            
            $table->string('edited_at');
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
        Schema::dropIfExists('historyprofiles');
    }
}
