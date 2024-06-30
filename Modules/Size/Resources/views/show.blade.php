@extends('Admin.layout')
@section('pagetitle', __('trans.sizes'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Model['title'] }}
        </td>

        @if($Model->Parent)
        <td class="text-center">
          @lang('trans.parent'):  {{ $Model->Parent->title }}
        </td>
        @endif
    </tr>
</table>

@endsection

