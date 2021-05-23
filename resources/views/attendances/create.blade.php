@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.attendance.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['attendances.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location', 'Location*', ['class' => 'control-label']) !!}
                    {!! Form::text('location', old('question'), ['class' => 'form-control', 'placeholder' => 'Insert Your Address']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('location'))
                        <p class="help-block">
                            {{ $errors->first('location') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

