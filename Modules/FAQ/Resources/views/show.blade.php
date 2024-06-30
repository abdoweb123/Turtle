@extends('Admin.layout')
@section('pagetitle', __('trans.FAQ'))
@section('content')

<table class="table">
    <tr>
        <td class="text-center">
            {{ $Parent['question_en'] }}
        </td>
        <td class="text-center">
            {{ $Parent['question_ar'] }}
        </td>
    </tr>
    <tr>
        <td class="text-center">
            {!! $Parent['answer_en'] !!}
        </td>
        <td class="text-center">
            {!! $Parent['answer_ar'] !!}
        </td>
    </tr>


</table>

@endsection

