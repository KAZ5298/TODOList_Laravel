<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>削除確認</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
</head>

<body>
    <!-- ナビゲーション -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <span class="navbar-brand">TODOリスト</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('item.index') }}">作業一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('item.create') }}">作業登録</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ $loginUser->name }}さん
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">ログアウト</button>
                        </form>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="./" method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search" value="">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">検索</button>
            </form>
        </div>
    </nav>
    <!-- ナビゲーション ここまで -->

    <!-- コンテナ -->
    <div class="container">
        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 alert alert-info">
                下記の項目を削除します。よろしいですか？
            </div>
            <div class="col-sm-3"></div>
        </div>

        <!-- 入力フォーム -->
        <div class="row my-2">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <form action="{{ route('item.destroy', $item) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="item_name">項目名</label>
                        <p name="item_name" id="item_name" class="form-control">{{ $item->item_name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="user_id">担当者</label>
                        <p name="user_id" id="user_id" class="form-control">{{ $item->user->name }}</p>
                    </div>
                    <div class="form-group">
                        <label for="expire_date">期限</label>
                        <p class="form-control" id="expire_date" name="expire_date">{{ $item->expire_date }}</p>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="finished_date" name="finished_date"
                            {{ isset($item->finished_date) ? 'checked disabled' : 'disabled' }}>
                        <label for="finished_date">完了</label>
                    </div>

                    <input type="submit" value="削除" class="btn btn-danger">
                    <input type="button" value="キャンセル" class="btn btn-outline-primary" onclick="location.href='../';">
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <!-- 入力フォーム ここまで -->

    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="{{ asset('/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
