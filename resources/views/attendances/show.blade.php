@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.attendance.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.attendance.fields.name')</th>
                        <th>@lang('quickadmin.attendance.fields.location')</th>
                        <th>@lang('quickadmin.attendance.fields.date')</th></tr>
                        <tr><td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->location }}</td>
                        <td>{{ $attendance->created_at}}</td></tr>

                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('attendances.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop