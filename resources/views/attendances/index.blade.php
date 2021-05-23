@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.attendance.title')</h3>

    <p>
        <a href="{{ route('attendances.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($attendances) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.attendance.fields.name')</th>
                        <th>@lang('quickadmin.attendance.fields.location')</th>
                        <th>@lang('quickadmin.attendance.fields.date')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($attendances) > 0)
                        @foreach ($attendances as $attendance)
                            <tr data-entry-id="{{ $attendance->id }}">
                                <td></td>
                                <td>{{ $attendance-> user->name or '' }}</td>
                                <td>{{ $attendance->location or '' }}</td>
                                <td>{!! $attendance->created_at !!}</td>
                                <td>
                                    <a href="{{ route('attendances.show',[$attendance->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('attendances.edit',[$attendance->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['attendances.destroy', $attendance->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('attendances.mass_destroy') }}';
    </script>
@endsection