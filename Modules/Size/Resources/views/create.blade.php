@extends('Admin.layout')
@section('pagetitle', __('trans.sizes'))
@section('content')
<form method="POST" action="{{ route('admin.sizes.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="title">@lang('trans.title')</label>
            <input id="title" type="text" name="title" required placeholder="@lang('trans.title')" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label >@lang('trans.parent')</label>
            <select name="parent_id" class="form-control" data-live-search="true">
                <option value="">{{ __('trans.Choose') }}</option>
                @foreach($Models as $size)
                    <option value="{{ $size['id'] }}">{{ $size->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-sm-12 my-4">
                <div class="text-center p-20">
                    <button type="submit" class="main-btn">{{ __('trans.add') }}</button>
                    <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
