@extends('Admin.layout')
@section('pagetitle', __('trans.sizes'))
@section('content')
<form method="POST" action="{{ route('admin.sizes.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <label for="title">@lang('trans.title')</label>
            <input id="title" type="text" name="title" required placeholder="@lang('trans.title')" class="form-control" value="{{ $Model['title'] }}">
        </div>
        @if($Model->children->count() == 0)
            <div class="form-group col-md-6">
                <label >@lang('trans.parent')</label>
                <select name="parent_id" class="form-control" data-live-search="true">
                    <option value="">{{ __('trans.Choose') }}</option>
                    @foreach($Models->whereNotIn('id',$Model->id) as $Single)
                        <option {{ $Model->parent_id == $Single->id ? 'selected' : '' }} value="{{ $Single['id'] }}">{{ $Single->title }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
