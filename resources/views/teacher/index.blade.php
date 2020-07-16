@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div style="float:left">{{ __('TEACHER LISTS') }}</div>
                <div style="float:right"><a href="{{'add'}}" class="btn btn-success">ADD TEACHER</a></div>
                </div>

                <div class="card-body">
                @if(Session::has('msg'))
                    <div class="alert alert-success" role="alert">
                    {{Session::get("msg")}}
                    </div>
                @endif

                @if(Session::has('err_msg'))
                    <div class="alert alert-danger" role="alert">
                    {{Session::get("err_msg")}}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        
                        <tr>
                        
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Description</th>
                        <th scope="col">Class</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($teacher_lists) && count($teacher_lists)>0)
                        @foreach($teacher_lists as $teacher_list)
                            @if(isset($teacher_list->name))
                            <tr>
                                <td>{{ $teacher_list->name }}</td>
                                <td>{{ $teacher_list->email }}</td>
                                <td>{{ $teacher_list->phone }}</td>
                                <td>{{ $teacher_list->subject }}</td>
                                <td>{{ $teacher_list->description }}</td>
                                <td>{{ $teacher_list->all_classes }}</td>
                                <td><a href="{{$teacher_list->id}}/edit">Edit</a></td>
                                <td><a href="{{$teacher_list->id}}/delete">Delete</a></td>
                            </tr>
                            @endif
                        @endforeach   
                    @endif   
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
