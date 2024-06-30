@extends('Admin.layout')
@section('pagetitle', __('trans.services'))
@section('content')

<table class="table">
    <tr>
        <td colspan="2" class="text-center">
            <img src="{{ asset($Model->file ?? setting('logo')) }}" class="rounded mx-auto text-center" id="file" height="200px">
        </td>
    </tr>
    <tr>
        <td class="text-center">
           <span style="font-weight: bold">@lang('trans.title_ar'): </span>  {{ $Model['title_ar'] }}
        </td>
        <td class="text-center">
           <span style="font-weight: bold">@lang('trans.title_en'): </span>  {{ $Model['title_en'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
         <span style="font-weight: bold"> @lang('trans.desc_ar'): </span>  {!! $Model['desc_ar'] !!}
        </td>
        <td class="text-center">
         <span style="font-weight: bold">  @lang('trans.desc_en'): </span> {!! $Model['desc_en'] !!}
        </td>
    </tr>
</table>

@endsection
