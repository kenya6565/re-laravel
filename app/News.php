<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    //プライマリーキーの指定

    // 以下を追記
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        //バリデーションのルール設定
    );
    
     // 以下を追記
    // Newsモデルに関連付けを行う
    public function histories()
    {
      return $this->hasMany('App\History');
      //レコードを複数取得する

    }
}

//ここ（Model )でnews テーブルにニュースのデータを格納します。