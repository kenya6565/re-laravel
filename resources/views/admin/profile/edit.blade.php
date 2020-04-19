@extends('layouts.admin')
@section('title', 'プロフィール編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>profile編集画面</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <input type="hidden" name="id" value="{{ $profile_form->id }}">
                    <!--編集画面でボタンが押された瞬間にidというキーがupdateメソッドに渡されてupdateメソッド内でidが呼ばれたときに $profile_form->idが値として取り出される
                     $profile_form->idとは更新された後の情報-->
                    
                    <div class="form-group row">
                        <label class="col-md-2">氏名(name)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ $profile_form->name }}">
                            <!--第一引数はもし更新ボタンを押してエラーになった際に入力した場所はそのまま表示されるようにする
                            第二引数を指定してあげることで編集ボタンを押した際に最初に記入していた内容を取得して表示できる 
                            波かっこがある時点でphpなので＄を書かなくてもいい可能性ある-->
                        </div>
                    </div>
                    
                     <div class="form-group row">
                        <label class="col-md-2">性別</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="gender" value="{{ $profile_form->gender }}">
                        </div>
                    </div>
                    
                      <div class="form-group row">
                        <label class="col-md-2">趣味(hobby)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ $profile_form->hobby}}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介欄(introduction)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="10">{{$profile_form->introduction}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->historyprofiles != NULL)
                                @foreach ($profile_form->historyprofiles as $history)
                                <!--ここには更新された情報のみが欲しいから$profile_formを使ってる-->
                                    <li class="list-group-item">{{ $history->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection