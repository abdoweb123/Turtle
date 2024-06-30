@extends('Admin.layout')
@section('pagetitle', __('trans.subscribers'))
@section('content')

    <div class="my-2 text-sm-end">
        <button type="button" id="DeleteSelected" onclick="DeleteSelected('subscribers')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
    </div>
    <table class="table table-bordered data-table" >
        <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>#</th>
            <th>@lang('trans.email')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($Models as $Model)
            <tr>
                <td>
                    <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">
                </td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $Model->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
