@extends('layout')

@section('content')

<head>
    <link rel="stylesheet" href="/css/index.css">
</head>

<body style="background-image:url('/image/UNADJUSTEDNONRAW_thumb_346.jpg');
       background-repeat:no-repeat;
       background-attachment: fixed; 
       background-size: cover;
       background-position: center center;

           
       ">



    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <nav class="panel panel-default">
                    <div class="panel-heading" style="display:flex;">
                        <p style="justify-content:space-around">フォルダ</p>
                        <a href="{{ route('folders.create') }}" class="btn btn-default" style="justify-content:space-around;margin:0 auto;">+</a>
                    </div>

                    <div class="hidden_box">
                        <input type="checkbox" id="label" />
                        <label for="label">フォルダ一覧</label>
                        <div class="hidden_show">
                            <div class="list-group">
                                @foreach($folders as $folder)
                                <a for="colum" href="{{ route('tasks.index',['id' => $folder->id])}}" class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                                    {{ $folder ->title }}
                                </a>
                                @endforeach
                            </div>
                </nav>
            </div>

            <div class="coloum col-md-8">
                <!-- タスクの表示 -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <P>タスク</P>
                        <div class="text-right">
                            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default">
                                タスクを追加する
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>タイトル</th>
                                    <th>状態</th>
                                    <th>期限</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                    </td>
                                    <td>{{ $task->formatted_due_date }}</td>
                                    <td><a href="{{ route('tasks.edit',['id' => $task->folder_id, 'task_id' => $task->id])}}">編集</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection