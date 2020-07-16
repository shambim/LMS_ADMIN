@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div style="float:left">{{ __('ATTENDANCE LISTS') }}</div>
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
                        
                        <th scope="col">Teacher name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($attendance_lists) && count($attendance_lists)>0)    
                        @foreach($attendance_lists as $attendance_list)
                            <tr>
                                <td>{{ $attendance_list->teacher_name }}</td>
                                <td>
                                @if($attendance_list->present_status=='' or $attendance_list->present_status==0)
                                {{ 'Absent' }}
                                @else 
                                {{'Present'}}
                                @endif
                                </td>
                                <td>
                                    <a href="{{url('teacher/assign_lists?status=1',$attendance_list->teacher_id)}}" class="btn btn-success">Mark as Present</a>
                                    <a href="{{url('teacher/assign_lists?status=0',$attendance_list->teacher_id)}}" class="btn btn-danger">Mark as Absent</a>
                                </td>
                            </tr>
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
