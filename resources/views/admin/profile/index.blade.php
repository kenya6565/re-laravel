
@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>プロフィール一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!--リンクを作る-->
                <a href="{{ action('Admin\ProfileController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\ProfileController@index') }}" method="get">
                    
                    <div class="form-group row">
                        <label class="col-md-2">名前</label><!--HTMLでフォームを作る時に、例えばテキストボックスの横に「名前」であったり、ラジオボタンの横に「男」「女」などの文字を
入れたいことがあります。その時に便利なタグ-->
                        <div class="col-md-8">
                            <!--<input>とは「INPUT」とは、<form>タグで作成したフォームの中でテキスト入力欄やボタンなどの部品を作成する要素です-->
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                            <!--ユーザーが入力した情報が検索ボタンが押された後に$cond_titleとして表示される-->
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
            <div class="admin-profile col-md-12 mx-auto">
               <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="10%">名前</th>
                                <th width="10%">性別</th>
                                <th width="10%">趣味</th>
                                <th width="50%">自己紹介</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $profile)
                                <tr>
                                    <th>{{ $profile->id }}</th>
                                    <th>{{ $profile->name}}</th>
                                    <th>{{ $profile->gender}}</th>
                                    <td>{{ str_limit($profile->hobby, 100) }}</td>
                                    <td>{{ str_limit($profile->introduction, 250) }}</td>
                                    <td>
                                        <div> <!--URLを生成しているURLではidと表示されそれにより＄newsのI'dが呼び出されている-->
                                              <!--editアクションにidというキーを渡している、それでそのidが呼ばれたときには$profileの中から特定のId情報を取り出す-->
                                            
                                            <a href="{{ action('Admin\ProfileController@edit', [ 'id' => $profile->id])}}">編集</a>
                                        </div>
                                         <div>
                                            <a href="{{ action('Admin\ProfileController@delete', ['id' => $profile->id]) }}">削除</a>
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