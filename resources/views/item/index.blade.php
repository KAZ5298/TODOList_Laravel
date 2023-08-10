<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>作業一覧</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <style>
        /* ボタンを横並びにする */
        form {
            display: inline-block;
        }

        /* 打消し線を入れる */
        tr.del>td {
            text-decoration: line-through;
        }

        /* ボタンのセルは打消し線を入れない */
        tr.del>td.button {
            text-decoration: none;
        }
    </style>
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
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('item.index') }}">作業一覧 <span class="sr-only">(current)</span></a>
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
            <form class="form-inline my-2 my-lg-0" action="{{ route('item.index') }}" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                    name="search" value="{{ $search }}">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">検索</button>
            </form>
        </div>
    </nav>
    <!-- ナビゲーション ここまで -->

    <!-- コンテナ -->
    <div class="container">

        <table class="table table-striped table-hover table-sm my-2">
            <thead>
                <tr>
                    <th scope="col">項目名</th>
                    <th scope="col">担当者</th>
                    <th scope="col">登録日</th>
                    <th scope="col">期限日</th>
                    <th scope="col">完了日</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    @if (isset($item->finished_date))
                        @php
                            $class = 'del';
                        @endphp
                    @elseif ($date > $item->expire_date)
                        @php
                            $class = 'text-danger';
                        @endphp
                    @else
                        @php
                            $class = '';
                        @endphp
                    @endif
                    @if ($item->is_deleted != 1)
                        <tr class="{{ $class }}">
                            <td class="align-middle">
                                {{ $item->item_name }}
                            </td>
                            <td class="align-middle">
                                {{ $item->user->name }}
                            </td>
                            <td class="align-middle">
                                {{ $item->registration_date }}
                            </td>
                            <td class="align-middle">
                                {{ $item->expire_date }}
                            </td>
                            <td class="align-middle">
                                @if (isset($item->finished_date))
                                    {{ $item->finished_date }}
                                @else
                                    未
                                @endif
                            </td>
                            <td class="align-middle button">
                                <form action="{{ route('item.complete', $item) }}" method="post" class="my-sm-1">
                                    @csrf
                                    @method('patch')
                                    <input class="btn btn-primary my-0" type="submit" value="完了">
                                </form>
                                <form action="{{ route('item.edit', $item) }}" method="post" class="my-sm-1">
                                    @csrf
                                    @method('get')
                                    <input class="btn btn-primary my-0" type="submit" value="修正">
                                </form>
                                <form action="{{ route('item.delete', $item) }}" method="post" class="my-sm-1">
                                    @csrf
                                    <input class="btn btn-primary my-0" type="submit" value="削除">
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>


    </div>
    <!-- コンテナ ここまで -->

    <!-- 必要なJavascriptを読み込む -->
    <script src="{{ asset('/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
