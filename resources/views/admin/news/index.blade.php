
@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>ニュース一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!--リンクを作る-->
                <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label><!--HTMLでフォームを作る時に、例えばテキストボックスの横に「名前」であったり、ラジオボタンの横に「男」「女」などの文字を
入れたいことがあります。その時に便利なタグ-->
                        <div class="col-md-8">
                            <!--<input>とは「INPUT」とは、<form>タグで作成したフォームの中でテキスト入力欄やボタンなどの部品を作成する要素です-->
                            <input type="text" class="form-control" name="cond_title" value="{{$cond_title}}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="admin-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $news)
                            <!--一週目はテーブルのid１を取り出して２週目は２を取り出して以下を行う〜というような動き-->
                                <tr>
                                    <th>{{ $news->id }}</th>
                                    <td>{{ str_limit($news->title, 100) }}</td>
                                    <td>{{ str_limit($news->body, 250) }}</td>
                                    <td>
                                        <div> <!--URLを生成しているURLではidと表示されそれにより＄newsのI'dが呼び出されている-->
                                            <a href="{{ action('Admin\NewsController@edit', ['id' => $news->id, 'hoge'=> $news->body]) }}">編集</a>
                                            <!--view→controllerに対する動き -->
                                            <!--foreach内だから1週目のときはこのI'dという風に特定できる-->
                                        </div>
                                         <div>
                                            <a href="{{ action('Admin\NewsController@delete', ['id' => $news->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection