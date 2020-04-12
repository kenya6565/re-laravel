<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
public function add()//ニュース画面新規作成
   {
   return view('admin.news.create');
   }
   
  public function create(Request $request)//ニュース画面新規作成で全項目入力後に行うメソッド
   {
          
   $this->validate($request, News::$rules);//Mewsクラスの $rulesを見てる→Newsクラス見に行こうとなる
    
   $news = new News; //instance
   //Newsクラスの情報を＄newsに入れてるとも考えられる
   $form = $request->all();//$requestに入ってる全てのオブジェクトを連想配列で＄formに代入
   //formタグで囲まれた全てのinputタグを入手
    
     // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
    if (isset($form['image'])) {
      $path = $request->file('image')->store('public/image');
      $news->image_path = basename($path);
    } else {
      $news->image_path = null;
    }
          
     // フォームから送信されてきた_tokenを削除する
    unset($form['_token']);
          // フォームから送信されてきたimageを削除する
    unset($form['image']);
          
          // 入力された情報をデータベースに保存する
          //どこのメソッド？
    $news->fill($form);
    $news->save();
    //$newsの出はnewsクラスなのでニュースクラスに定義されたメソッドだとわかる
          
    return redirect('admin/news/create');
    }
      
      
  public function index(Request $request) 
   {//ニュース画面一覧
            
            
    $cond_title = $request->cond_title;//$requestにあるcond_titleの値を取り出して変数に代入することで利用する
    //dd($cond_title);//cond_titleに何が入ってるかクニンできる
    if ($cond_title != '') {//もし検索窓が空欄では無い場合＝検索窓になんかしら文字が入っている時、
              
                  // 検索されたら検索結果を取得する
      $posts = News::where('title', $cond_title)->get();
     //getメソッドはwhereで検索した情報を実際に取得する
      //曖昧検索したいときは、
      //titleからむにcond_titleの一致があるか
      //SQL文のwhere,タイトルのデータからcond_titleと一致するものを抽出
      //メソッドチェーン（WHereメソッドが返すメソッドが持ってるメソッドのGET
                  //マイグレーションファイル内Newsテーブルの中のtitleと入力値が一致したものを探しに行きます
                  //newsテーブルの中のtitleカラムで$cond_title（ユーザーが入力した文字）に一致するレコードを全て取得することができます
    } else {
                  // それ以外はすべてのニュースを取得する
      $posts = News::all();
      //dd($posts);
    }
    return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);//admin/news/indexにある＄posts、$cond_titleがここで定義されている
    }    
         //変数をHTMLに渡したいときは名前の付け直しが必要→定義
          //Bladeファイルのために名前を付け直してる
          
    
  public function edit(Request $request)
         //ニュース編集画面
              {
               // News Modelからデータを取得する
   $news = News::find($request->id);
   //?のあとで値を持たせる→URLクエリ
   //URL についているI'd
   //自動的にsqlのnewsテーブルにアクセスして特定の情報をとる
   //このidはViewで作った（index)urlのid!→idがキーとなって$news->idが呼び出されてる
   //ここで取り出してるURLがViewと違ったら＄requestから何も取り出せないので404エラーとなる
   
   if (empty($news)) {//aaaaaは単なるパラメーター、News::findによってニューステーブルの特定の情報１行（bodyとか名前とか）を＄newsに入れてる
     abort(404);    
    }
    return view('admin.news.edit', ['news_form' => $news]);//bladeにnews_formという名前でbladeに渡してる,simpleでも可能
    }//ここで手に入れたID情報を格納した変数（＄news)の情報をbladeファイルにNews_formという名前であげる
    
            //Requestクラスは、ブラウザを通してユーザーから送られる情報をすべて含んでいるオブジェクトを取得する
  public function update(Request $request)
   {
                  // Validationをかける
   $this->validate($request, News::$rules);
   //＄thisはこのコントローラを指してる、＄validateは Controllerクラスに定義されてる
                  // News Modelからデータを取得する
                  //各テーブルに自動的につく連番
   $news = News::find($request->id);
                  // 送信されてきたフォームデータを格納する
                  //$requestに定義されたallメソッドを使ってる
   $news_form = $request->all();//all関数
                  
                       // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
                    
   if (isset($news_form['image'])) {
                    //このImageはHTMLで定義されてるnameの名前（nameとはユーザーが入力した値（Value)のキー
                    //この場合Image(name)を呼び出すと $news_form = $request->all();(Value=値)が呼び出されることになる
    $path = $request->file('image')->store('public/image');
    $news->image_path = basename($path);
                       // フォームから送信されてきた_tokenを削除する
    unset($news_form['image']);
                      
    } elseif (isset($request->remove)) {
    
    $news->image_path = null;
    unset($news_form['remove']);
    }
    
    unset($news_form['_token']);//all関数で受け取った情報の中にトークンも入ってる
                  // 該当するデータを上書きして保存する
                  
                  //$news=newsモデルを扱うインスタンスだからニュースのDBを参照
                  //$news = News::find($request->id);で取得したテーブル情報を$news_formに入れて保存
                  
   $news->fill($news_form)->save();
            
    return redirect('admin/news');
    }
              
              
              
        
                   // 以下を追記　　
  public function delete(Request $request)
   {
                // 該当するNews Modelを取得
   $news = News::find($request->id);
                // 削除する
   $news->delete();
   return redirect('admin/news/');
   }  

}
