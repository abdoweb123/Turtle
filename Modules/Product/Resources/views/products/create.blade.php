@extends('Admin.layout')
@section('pagetitle', __('trans.add') . ' ' . __('trans.device'))
@section('content')


<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="title_ar">@lang('trans.title_ar')</label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}" required placeholder="@lang('trans.title_ar')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="title_en">@lang('trans.title_en')</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" required placeholder="@lang('trans.title_en')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('trans.quantity')</label>
                <input type="number" min="0" name="product_quantity" value="{{ old('product_quantity') }}" required placeholder="@lang('trans.quantity')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('trans.price')</label>
                <input type="number" min="0" step="any" name="price" value="{{ old('price') }}" required placeholder="@lang('trans.price')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('trans.weight')</label>
                <input type="number" min="0" step="any" name="weight" value="{{ old('weight') }}" required placeholder="@lang('trans.weight')" class="form-control">
            </div>
            <div class="col-md-6">
                <label>@lang('trans.isThereDiscount')</label>
                <select id="discountDiscount" name="have_discount"  class="form-control">
                    <option value="1">@lang('trans.yes')</option>
                    <option selected value="0">@lang('trans.no')</option>
                </select>
            </div>
            <div class="col-md-6 discount {{ old('discount') ? '' : 'hide' }}">
                <label class="my-1">@lang('trans.discount') <span class="h4">%</span></label>
                <input id="discount" type="number" step="any" value="0" name="discount_value" min="0" max="100" placeholder="@lang('trans.discount')" class="form-control">
            </div>
            <div class="col-md-6 discount {{ old('from') ? '' : 'hide' }}">
                <label class="my-1">@lang('trans.discount_from')</label>
                <input id="discount_from" type="datetime-local" name="discount_from" placeholder="@lang('trans.discount_from')" class="form-control">
            </div>
            <div class="col-md-6 discount {{ old('to') ? '' : 'hide' }}">
                <label class="my-1">@lang('trans.discount_to')</label>
                <input id="discount_to" type="datetime-local" name="discount_to" placeholder="@lang('trans.discount_to')" class="form-control">
            </div>



            <hr style="color: transparent">

{{--            <div class="col-md-6">--}}
{{--                <label for="header" class="form-label">@lang('trans.header')</label>--}}
{{--                <input class="form-control" name="header" type="file">--}}
{{--            </div>--}}
{{--            <div class="row d-flex justify-content-center my-2"></div>--}}
{{--            <div class="col-md-6">--}}
{{--                <label class="my-1">@lang('trans.Gallery')</label>--}}
{{--                <input class="form-control" accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" multiple type="file" name="gallery[]">--}}
{{--            </div>--}}
            <div class="row d-flex justify-content-center my-2"></div>


{{--            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">--}}
{{--                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">--}}
{{--                    <h2 >@lang('trans.items')</h2>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 justify-content-center">--}}
{{--                <label class="form-label">@lang('trans.color')</label>--}}
{{--                <select class="form-control" id="size_id" name="colorIds[]" multiple>--}}
{{--                    <option value="" selected disabled hidden>----------</option>--}}
{{--                    @foreach (Colors() as $Item)--}}
{{--                        <option value="{{ $Item->id }}">{{ $Item->title() }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 justify-content-center">--}}
{{--                <label class="form-label">@lang('trans.size')</label>--}}
{{--                <select class="form-control" id="color_id" name="sizeIds[]" multiple>--}}
{{--                    <option value="" selected disabled hidden>----------</option>--}}
{{--                    @foreach (Sizes() as $Item)--}}
{{--                        @if($Item->parent_id==null)--}}
{{--                            <option value="{{ $Item->id }}">{{ $Item->title }}</option>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <div  class="my-5"  style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">--}}
            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.items')</h2>
                </span>
            </div>
{{--            <button type="button" id="add_item" class="btn btn-primary">+</button>--}}
            <div id="items_container" class="">
                <div class="item row p-2 row items_block position-relative my-3 border border-dark">
                    <div class="col-md-6">
                        <label>@lang('trans.color'):</label>
                        <select name="colors[]" class="form-control" required>
                            <option value="">@lang('trans.Select')</option>
                            @foreach(Colors() as $color)
                                <option value="{{ $color->id }}">{{ $color['title_'.lang()] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>@lang('trans.parent') (@lang('trans.size')):</label>
                        <select name="parent_sizes[]" class="form-control" required onchange="loadSubSizes(this)">
                            <option value="">@lang('trans.Select')</option>
                            @foreach(Sizes() as $size)
                                <option value="{{ $size->id }}">{{ $size->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>@lang('trans.category') (@lang('trans.size')):</label>
                        <select name="sub_sizes[]" class="form-control" required>
                            <option value="">____</option>

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity">@lang('trans.quantity')</label>
                        <input type="number" min="1" name="quantity[]" value="{{ old('quantity'),1 }}" required placeholder="@lang('trans.quantity')" class="form-control">
                    </div>
                    <button class="btn btn-danger position-absolute remove_items text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>
                </div>
            </div>
            <div class="row border-0 my-1">
                <div class="items_block"></div>
                <div class="col-md-1 mx-auto text-center">
                    <button class="main-btn text-center mx-auto" type="button" id="add_item">+</button>
                </div>
            </div>

            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.categories')</h2>
                </span>
            </div>
            <div class="col-md-6">
                <label class="form-label">@lang('trans.parent')</label>
                <select class="form-control selectpicker" data-live-search="true" id="parent_id">
                    <option value="" selected disabled hidden>----------</option>
                    @foreach ($Categories as $Item)
                        <option value="{{ $Item->id }}">{{ $Item->title() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">@lang('trans.category')</label>
                <select class="form-control selectpicker" data-live-search="true" id="category_id" name="categories[]">

                </select>
            </div>
            <div class="col-12 my-2" style="display: flex;justify-content: space-evenly;">
            </div>

            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.leather')</h2>
                </span>
            </div>
            <div class="col-md-6">
                <label class="form-label d-block">@lang('trans.leather')</label>
                <div class="d-block">
                    <input type="radio" name="material" value="1"> @lang('trans.exotic_leather')
                </div>
                <div class="d-block">
                    <input type="radio" name="material" value="2"> @lang('trans.non_exotic_leather')
                </div>
            </div>
            <div class="col-12 my-2" style="display: flex;justify-content: space-evenly;">
            </div>

            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.description')</h2>
                </span>
            </div>
            <div class="row">
                <div class="col-md-6 justify-content-center">
                    <label class="form-label">@lang('trans.description_ar')</label>
                    <textarea name="long_desc_ar"></textarea>
                </div>

                <div class="col-md-6 justify-content-center">
                    <label class="form-label">@lang('trans.description_en')</label>
                    <textarea name="long_desc_en"></textarea>
                </div>
            </div>

            <hr style="color: transparent" class="my-4">


            <hr style="color: transparent">


            <div class="row">
                <div class="col-sm-12 my-4">
                    <div class="text-center p-20">
                        <button type="submit" class="btn btn-primary">{{ __('trans.add') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('trans.cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection





@section('css')
<link rel="stylesheet" href="https://unpkg.com/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<style>
    .features_block {
        border: 1px solid #CCC;
        margin: 10px 0px;
        padding: 10px 0px;
    }
</style>
@endsection



@section('js')
<script src="https://unpkg.com/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(".selectpicker").selectpicker();
    features_i = 1;
    items_i = 9999;
    $(document).on('click', '#selectAll', function() {
        $('#permissions option').attr("selected", "selected");
        $(".selectpicker").selectpicker('refresh');
    });
    $(document).on('change', 'input[type="file"]', function() {
        var Preview = $(this).parent().next();
        Preview.empty();
        files = this.files;
        if (files && files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                file = files[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    const fileType = file.type;
                    if (fileType.startsWith('image/')) {
                        var image = $("<img>").attr("src", e.target.result);
                        image.addClass("preview_image");
                        Preview.append(image);
                    } else if (fileType.startsWith('video/')) {
                        var video = $("<video>").attr("src", e.target.result);
                        video.addClass("preview_image");
                        Preview.append(video);
                    } else {
                      console.log('Unknown file type.');
                    }
                };
                reader.readAsDataURL(file);
            }
        }
    });
    $(document).on('change', '#discountDiscount', function() {
        if ($(this).val() === '1') {
            $('.discount').removeClass('hide');
        } else {
            $('.discount').addClass('hide');
            $('#discount').val('');
            $('#discount_from').val('');
            $('#discount_to').val('');
        }
    });



    $(document).on("change", "#parent_id", function() {
        SubCat();
    });
    $(document).on("change", "#category_id", function() {
        $(this).parent().parent().next().append('<div class="position-relative" style="width: fit-content;"><input name="categories[]" type="hidden" value="' + $( "#category_id option:selected" ).val() + '"><button type="button" class="btn btn-dark">'+ $( "#category_id option:selected" ).attr('data-parent') +' -> '+ $( "#category_id option:selected" ).text() +'</button><i data-path="" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i></div>');
        SubCat();
    });
    $(document).on('click', '.fa-circle-xmark', function() {
        item = $(this);
        item.parent().remove();
        SubCat();
    });
    function SubCat() {
        $('select#category_id').empty();
        $('select#category_id').append('<option value="" selected>----------</option>');
        $.each(@json($Categories), function(key, ParentCategory) {
            if ($('#parent_id').find("option:selected").val() == ParentCategory['id']) {
                $.each(ParentCategory['children'], function(key, Category) {
                    exist = 0;
                    $.each($('input[name="categories[]"]'), function(key, item) {
                        exist += Category['id'] == item.value ? 1 : 0
                    });
                    if(exist == 0){
                        $('select#category_id').append('<option data-parent="' + Category['parent']['title_{{ lang() }}'] + '" value="' + Category['id'] + '">' + Category['title_{{ lang() }}'] + '</option>');
                    }
                });
            }
        });
        $(".selectpicker").selectpicker('refresh');
    }


    {{--$(document).on('click', '.add_items', function() {--}}
    {{--    $('<div class="row items_block position-relative my-3 border border-dark">'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<label for="items['+items_i+'][size_id]">@lang("trans.size")</label>'+--}}
    {{--        '<select class="form-control" id="items['+items_i+'][size_id]" name="items['+items_i+'][size_id]"></select>'+--}}
    {{--        '</div>'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<label for="items['+items_i+'][size_id]">@lang("trans.sub_size")</label>'+--}}
    {{--        '<select class="form-control" id="items['+items_i+'][size_id]" name="items['+items_i+'][size_id]"></select>'+--}}
    {{--        '</div>'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<label for="items['+items_i+'][color_id]">@lang("trans.color")</label>'+--}}
    {{--        '<select class="form-control" id="items['+items_i+'][color_id]" name="items['+items_i+'][color_id]"></select>'+--}}
    {{--        '</div>'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<label for="quantity">@lang("trans.quantity")</label>'+--}}
    {{--        '<input type="text" min="0"  name="items['+items_i+'][quantity]" placeholder="@lang("trans.quantity")" class="form-control">'+--}}
    {{--        '</div>'+--}}
    {{--        '<div class="col-md-6">'+--}}
    {{--        '<label for="price">@lang("trans.price")</label>'+--}}
    {{--        '<input type="number" step="0.01" min="0" name="items['+items_i+'][price]" placeholder="@lang("trans.price")" class="form-control">'+--}}
    {{--        '</div>'+--}}
    {{--        '<button class="btn btn-danger position-absolute remove_items text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>'+--}}
    {{--        '<hr class="my-2">'+--}}
    {{--        '</div>'--}}
    {{--    ).insertAfter('.items_block:last');--}}

    {{--    $.each(@json(Sizes()), function (key,Item) {--}}
    {{--        $('select[name="items['+items_i+'][size_id]"]').append( '<option value="'+Item['id']+'">'+Item['title']+'</option>' );--}}
    {{--    });--}}
    {{--    $.each(@json(Colors()), function (key,Item) {--}}
    {{--        $('select[name="items['+items_i+'][color_id]"]').append( '<option value="'+Item['id']+'">'+Item['title_{{ lang() }}']+'</option>' );--}}
    {{--    });--}}
    {{--    features_i++;--}}
    {{--});--}}
    // $(document).on('click', '.remove_items', function() {
    //     $(this).parent().remove();
    // });



</script>


<script>
    // to add new item
    $(document).ready(function(){
        $('#add_item').click(function(){
            var newItem = $('.item').first().clone();
            newItem.find('select').val('');
            newItem.find('select[name="sub_sizes[]"] option:not(:first-child)').remove(); // Remove all options except the first one
            newItem.find('input').val(''); // Clear input values
            $('#items_container').append(newItem);
        });
    });

    $(document).on('click', '.remove_items', function() {
        $(this).parent().remove();
    });
</script>

<script>
    // to get subsizes when click on parent size
    function loadSubSizes(parentSizeSelect) {
        var parentSizeId = parentSizeSelect.value;
        var subSizeSelect = parentSizeSelect.parentElement.nextElementSibling.querySelector('select');

        // Make an AJAX request to fetch the sub sizes
        $.ajax({
            url: '{{route('admin.getSubSizes')}}',
            method: 'GET',
            data: { parent_size_id: parentSizeId },
            success: function(response) {
                // Clear previous options
                subSizeSelect.innerHTML = '<option value="">____</option>';

                // Append new options
                response.forEach(function(subSize) {
                    var option = document.createElement('option');
                    option.value = subSize.id;
                    option.text = subSize.title;
                    subSizeSelect.appendChild(option);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            // Check if colors are present and validate each color
            if ($('select[name="colors[]"]').length > 0) {
                $('select[name="colors[]"]').each(function() {
                    var color = $(this).val();
                    if (!color) {
                        event.preventDefault(); // Prevent form submission
                        alert('Please select a color for each item.');
                        return false;
                    }
                });
            }

            // Check if parent sizes are present and validate each parent size
            if ($('select[name="parent_sizes[]"]').length > 0) {
                $('select[name="parent_sizes[]"]').each(function() {
                    var parentSize = $(this).val();
                    if (!parentSize) {
                        event.preventDefault(); // Prevent form submission
                        alert('Please select a parent size for each item.');
                        return false;
                    }
                });
            }

            // Check if quantities are present and validate each quantity
            if ($('input[name="quantity[]"]').length > 0) {
                $('input[name="quantity[]"]').each(function() {
                    var quantity = $(this).val();
                    if (!quantity) {
                        event.preventDefault(); // Prevent form submission
                        alert('Please enter a quantity for each item.');
                        return false;
                    }
                });
            }
        });
    });
</script>
@endsection



