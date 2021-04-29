@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.forums.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.forums.fields.question')</th></tr>
                        <tr><td>{{ $forum->question }}</td></tr>

                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('forums.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop