@extends('Admin.layout')
@section('pagetitle', __('trans.order'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['title_en'] }}
        </td>
        <td class="text-center">
            {{ $Model['title_ar'] }}
        </td>
    </tr>
</table>

@endsection

