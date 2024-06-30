@extends('Admin.layout')
@section('pagetitle', $Branch->title())
@section('content')

<form action="{{ route('admin.branch.category.update',['branch' => $Branch ,'category' => $Category ]) }}" method="POST">
    @csrf
    <table class="table dataTable data-table" id="DataTable">
        <thead>
            <tr>
                <th>#</th>
                <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
                <th>@lang('trans.title_ar')</th>
                <th>@lang('trans.title_en')</th>
            </tr>
        </thead>
        <tbody class="text-center" data-table="categories">
            @foreach($Category->children as $sub_category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><input type="checkbox" @checked($Branch->categories->pluck('id')->contains($sub_category->id)) class="DTcheckbox" value="{{ $sub_category->id }}" name="categories[]"></td>
                    <td><a href="{{ route('admin.branch.category.devices',['branch' => $Branch ,'category' => $sub_category ]) }}">{{ $sub_category->title_ar }}</a></td>
                    <td><a href="{{ route('admin.branch.category.devices',['branch' => $Branch ,'category' => $sub_category ]) }}">{{ $sub_category->title_en }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="clearfix"></div>
    <div class="col-12 my-4">
        <div class="button-group">
            <button type="submit" class="main-btn btn-hover w-100 text-center">
                {{ __('trans.Submit') }}
            </button>
        </div>
    </div>
</form>
@endsection

