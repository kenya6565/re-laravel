<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     protected $guarded = array('gender');

    // 以下を追記
    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    
    public function historyprofiles()
    {
    return $this->hasMany('App\Historyprofile');
    //テーブルに関連づいているhistoriesテーブルを全て取得するというメソッドになっています。ここだったらHistoriesテーブルに関連づけた（送った）
    //profilesテーブルのレコード（行）全てを取得してる
    
    
    //ここに関連づけるモデルの名前？

    }
}
