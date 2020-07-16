@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div style="float:left">{{ __('CLASS LISTS') }}</div>
                <div style="float:right"><a href="{{'add'}}" class="btn btn-success">ADD CLASS</a></div>
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
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(isset($class_lists) && count($class_lists)>0)    
                        @foreach($class_lists as $class_list)
                            <tr>
                                <td>{{ $class_list->name }}</td>
                                <td><a href="{{$class_list->id}}/edit">Edit</a></td>
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
