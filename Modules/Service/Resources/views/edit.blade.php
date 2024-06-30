@extends('Admin.layout')
@section('pagetitle', __('trans.services'))
@section('content')
<form method="POST" action="{{ route('admin.services.update',$Model) }}" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="text-center">
        <img src="{{ asset($Model->file ?? setting('logo')) }}" class="rounded mx-auto text-center" id="file"  height="200px">
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="title_ar">@lang('trans.title_ar')</label>
            <input id="title_ar" type="text" name="title_ar" required placeholder="@lang('trans.title_ar')" class="form-control" value="{{ $Model['title_ar'] }}">
        </div>
        <div class="col-md-6">
            <label for="title_en">@lang('trans.title_en')</label>
            <input id="title_en" type="text" name="title_en" required placeholder="@lang('trans.title_en')" class="form-control" value="{{ $Model['title_en'] }}">
        </div>
{{--        <div class="col-md-6">--}}
{{--            <label for="link">@lang('trans.link')</label>--}}
{{--            <input id="link" type="text" name="link" placeholder="@lang('trans.link')" class="form-control" value="{{ $Model['link'] }}">--}}
{{--        </div>--}}
        <div class="col-md-6 col-sm-12">
            <label for="file">{{ __('trans.file') }}</label>
            <input class="form-control w-100" id="file" type="file" name="file" onchange="document.getElementById('file').src = window.URL.createObjectURL(this.files[0])">
        </div>
        <div class="col-md-6 col-sm-12">
        </div>
        <div class="col-md-6 col-sm-12">
            <label >@lang('trans.desc_ar')</label>
            <textarea name="desc_ar" placeholder="@lang('trans.desc_ar')" class="form-control mceNoEditor editor" required>{!! $Model['desc_ar'] !!}</textarea>
        </div>
        <div class="col-md-6 col-sm-12">
            <label >@lang('trans.desc_en')</label>
            <textarea name="desc_en" placeholder="@lang('trans.desc_en')" class="form-control mceNoEditor editor" required>{!! $Model['desc_en'] !!}</textarea>
        </div>
        
        <div class="col-12">
            <div class="button-group my-4">
                <button type="submit" class="main-btn btn-hover w-100 text-center">
                    {{ __('trans.Submit') }}
                </button>
            </div>
        </div>
    </div>
{{--    <textarea id="editor"></textarea>--}}
</form>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        // Initialize CKEditor on textarea elements with class 'editor'
        document.addEventListener('DOMContentLoaded', function () {
            var textareas = document.querySelectorAll('.editor');
            Array.prototype.forEach.call(textareas, function (textarea) {
                CKEDITOR.replace(textarea);
            });
        });

        // Access the HTML content of the editor when needed
        function getEditorContent() {
            var textareas = document.querySelectorAll('.editor');
            Array.prototype.forEach.call(textareas, function (textarea) {
                var editor = CKEDITOR.instances[textarea.id];
                if (editor) {
                    var htmlContent = editor.getData();
                    console.log(htmlContent);
                }
            });
        }
    </script>
@stop