<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Historyprofile;


use App\Profile;


class ProfileController extends Controller
{
  public function add()
  {
      return view ('admin.profile.create');
  }//
  
  public function create(Request $request)
  {
    
    
 $this->validate($request, Profile::$rules);

 $profile = new Profile;
 $form = $request->all();



      // データベースに保存する
  $profile->fill($form);
  $profile->save();
      
      
  return redirect ('admin/profile');
   }
   
  public function index(Request $request) 
  {
            
            
  $cond_title = $request->cond_title;//$requestにあるcond_titleの値を取り出して変数に代入することで利用する
    //dd($cond_title);//cond_titleに何が入ってるかクニンできる
    if ($cond_title != '') {//もし検索窓が空欄では無い場合＝検索窓になんかしら文字が入っている時、
              
                  // 検索されたら検索結果を取得する
      $posts = Profile::where('name', $cond_title)->get();
     //getメソッドはwhereで検索した情報を実際に取得する
      //曖昧検索したいときは、
      //titleからむにcond_titleの一致があるか
      //SQL文のwhere,タイトルのデータからcond_titleと一致するものを抽出
      //メソッドチェーン（WHereメソッドが返すメソッドが持ってるメソッドのGET
                  //マイグレーションファイル内Newsテーブルの中のtitleと入力値が一致したものを探しに行きます
                  //newsテーブルの中のtitleカラムで$cond_title（ユーザーが入力した文字）に一致するレコードを全て取得することができます
    } else {
                  // それ以外はすべてのニュースを取得する
      $posts = Profile::all();
      //dd($posts);
    }
  return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);//admin/news/indexにある＄posts、$cond_titleがここで定義されている
  }    
         //変数をHTMLに渡したいときは名前の付け直しが必要→定義
          //Bladeファイルのために名前を付け直してる
  
  public function edit(Request $request)
  {
    
    $profile = Profile::find($request->id);
    if (empty($profile)) {//DBのprofileのテーブルを参照してもし$profileにデータがなかったらエラー404を表示する
      abort(404);    
    }
   
  return view('admin.profile.edit', ['profile_form' => $profile]);
      
  }

  public function update(Request $request)
  {
                  // Validationをかける
                  //
    $this->validate($request, Profile::$rules);
    
                    // News Modelからデータを取得する
    $profile = Profile::find($request->id);
    //編集前のデータが$profileに入ってる
    
                    // 送信されてきたフォームデータを格納する
                    
    $profile_form = $request->all();
    //書き換えられた新データをこっちで入れてる
    //dd($profile_form);
    
     unset($profile_form['_token']);
     //トークンを消す
    
    $profile->fill($profile_form)->save();
    //$profileに＄profile_formの新情報を入れてSaveしてる
    
    
    
    $history = new Historyprofile;
    
    $history->profile_id = $profile->id;
    
    $history->edited_at = Carbon::now();
    
    $history->save();
    
    
  
    return redirect('admin/profile');
  }
}
