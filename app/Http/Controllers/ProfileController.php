<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    
    public function index(Request $request)
    {
        $posts = Profile::all()->sortByDesc('updated_at');
        //カッコの中の値（キー）でソートするためのメソッド
        //News::all()->sortByDesc('updated_at')は、「投稿日時順に新しい方から並べる」という並べ換えをしていることを意味しています。

        if (count($posts) > 0) {
            $headline = $posts->shift();
            /*shift()メソッドは、配列の最初のデータを削除し、その値を返すメソッドです。

              配列を左にシフトする動作をするので、shiftメソッドと呼ばれます。
              
              例）
              $collection = array(“a”,”b”,”c”,”d”);
              $collection>shift();
              →”a”こっちではaが返され
              
              $collection->all();
              →array(“b”,”c”,”d”)　
              こっちでは残りのb、c、dが返される*/
              

        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('profile.index', ['headline' => $headline, 'posts' => $posts]);
    }
    //
}


