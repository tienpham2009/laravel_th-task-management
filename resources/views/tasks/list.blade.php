@extends('tasks.home')

@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Tasks List
        </div>
        <div>
            @if(!isset($tasks))
                <h5 class="text-primary">Dữ liệu không tồn tại!</h5>
            @else
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Created</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Image</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($tasks) == 0)
                        <tr>
                            <td colspan="5"><h5 class="text-primary">Hiện tại chưa có task nào được tạo!</h5></td>
                        </tr>
                    @else
                        @foreach($tasks as$key =>$task)
                            <tr>
                                <td scope="row">{{ ++$key }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->content }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    <img src="{{ asset('storage/images/' . $task->image) }}" alt="" style="width: 150px">
                                </td>
                                <td>
                                    <a href="{{route('tasks.edit' , $task->id)}}" type="button" class="btn btn-primary">edit</a>
                                    <a href="{{route('tasks.delete' , $task->id)}}" type="button" class="btn btn-danger">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>
@endsection
