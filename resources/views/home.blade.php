@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">

                    <div class="card-columns">
                        
                        <div class="card bg-danger">
                            <div class="card-body text-center">
                            <p class="card-text"><a  style="font-weight:bold;color:#FFF !important" href="{{url('teacher/lists')}}">Teacher<br/>Lists</a></p>
                            </div>
                        </div>
                        <div class="card bg-primary">
                            <div class="card-body text-center">
                            <p class="card-text"><a  style="font-weight:bold;color:#FFF !important" href="{{url('allclass/lists')}}">Class<br/>Lists</a></p>
                            </div>
                        </div>

                        <div class="card bg-secondary">
                            <div class="card-body text-center">
                            <p class="card-text"><a  style="font-weight:bold;color:#FFF !important" href="{{url('teacher/attendance_lists')}}">Attendance<br/>Lists</a></p>
                            </div>
                        </div>
                        
                    </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
