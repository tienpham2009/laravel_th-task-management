<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tasks = Task::all();
        return view('index', compact('tasks'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->inputTitle;
        $task->content = $request->inputContent;
        $task->due_date = $request->inputDueDate;

        $file = $request->inputFile;
        // Nếu file không tồn tại thì trường image gán bằng NULL

        if (!$request->hasFile('inputFile')) {
            $task->image = $file;
        } else {
            //Lấy ra định dạng và tên mới của file từ request
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = $request->inputFileName;

            // Gán tên mới cho file trước khi lưu lên server
            $newFileName = "$fileName.$fileExtension";

            //Lưu file vào thư mục storage/app/public/image với tên mới
            $request->file('inputFile')->storeAs('public/images', $file);

            // Gán trường image của đối tượng task với tên mới
            $task->image = $file;
        }
        $task->save();

        $message = "Tạo Task $request->inputTitle thành công!";
        Session::flash('create-success', $message);
        return redirect()->route('tasks.index', compact('message'));
    }

    public function showList(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $tasks = Task::all();
        return view('tasks.list' , compact('tasks'));
    }
}
