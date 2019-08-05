<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // get で tasks/ にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $tasks = Task::all();
        
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // get で tasks/create/ にアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    // post で tasks/ にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
        ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
        return redirect('/');
    }

    // get で tasks/id/ にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = Task::find($id);
        
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // get で tasks/id/edit にアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $task = Task::find($id);
        
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // put または patch で tasks/id にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
        ]);

        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    // delete で tasks/id にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return redirect('/');
    }
}
