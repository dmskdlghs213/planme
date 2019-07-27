<?php

namespace App\Http\Controllers;


use App\Folder;
use App\Task;
use App\Http\Requests\CreateTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditTask;


class TaskController extends Controller
{
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */

    public function index(Folder $folder)
    {
        #全てのフォルダを取得する
        #$folders = Folder::all();

        //ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();


        #選ばれたフォルダを取得する(フォルダテーブルから検索して値を返す)
        #$current_folder = Folder::find($id);

        #選ばれたフォルダに紐付くタスクを取得する
        $tasks = $folder->tasks()->get();

        #受け取った値をテンプレートに返す処理
        //第一引数がテンプレートファイル名
        //第二引数で配列で渡しテンプレート側で参照する変数に
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View 
     */

    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request 
     * @return \Illuminate\Http\RedirectResponse 
     */


    public function create(Folder $folder, CreateTask $request)
    {
        //現在保存されてるフォルダを取得する
        #$current_folder = Folder::find($id);

        //新しいタスクを作成して必要項目を追加する
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        //現在保存されてるフォルダに新しいタスクを追加して保存する
        #$current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }


    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task 
     * @return \Illuminate\View\View
     */

    public function showEditForm(Folder $folder, Task $task)
    {

        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task 
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse 
     */

    public function edit(Folder $folder, Task $task, EditTask $request)
    {

        //リクエストされたIDでタスクデータを取得(編集対象データ)
        #$task = Task::find($task_id);

        $this->checkRelation($folder, $task);

        //編集対象のタスクでーたに入力値を詰めてsaveする
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        //編集対処のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    /**
     * フォルダとタスクの関連性があるかどうか調べる
     * @param Folder $folder
     * @param Task $task 
     */

    public function checRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
