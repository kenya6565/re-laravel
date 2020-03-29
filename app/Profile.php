<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        '名前(name)' => 'required',
        '性別(gender)' => 'required',
        '趣味(hobby)' => 'required',
        '自己紹介(introduction)' => 'required',
    );
}
