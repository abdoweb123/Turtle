@extends('Admin.layout')
@section('pagetitle', __('trans.products'))
@section('content')

    <form id="productForm" method="POST" action="{{ route('admin.products.update',$Product) }}" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <label for="title_ar">@lang('trans.title_ar')</label>
                <input type="text" name="title_ar" required placeholder="@lang('trans.title_ar')" class="form-control" value="{{ $Product['title_ar'] }}">
            </div>
            <div class="col-md-6">
                <label for="title_en">@lang('trans.title_en')</label>
                <input type="text" name="title_en" required placeholder="@lang('trans.title_en')" class="form-control" value="{{ $Product['title_en'] }}">
            </div>
            <div class="col-md-6">
                <label for="quantity">@lang('trans.quantity')</label>
                <input type="number" min="0" name="product_quantity" value="{{ $Product['quantity'] }}" required placeholder="@lang('trans.quantity')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('trans.price')</label>
                <input type="number" min="0" name="price" step="any" value="{{ $Product['price'] }}" required placeholder="@lang('trans.price')" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="price">@lang('trans.weight')</label>
                <input type="number" min="0" step="any" name="weight" value="{{ $Product['weight'] }}" required placeholder="@lang('trans.weight')" class="form-control">
            </div>
            <div class="col-md-6">
                <label >
                    <span>@lang('trans.isThereDiscount')</span>
                </label>
                <select id="discountDiscount" name="have_discount" class="form-control">
                    <option {{  $Product->discount_value > 0 ? 'selected' : '' }} value="1">@lang('trans.yes')</option>
                    <option {{  $Product->discount_value > 0 ? '' : 'selected' }} value="0">@lang('trans.no')</option>
                </select>
            </div>
            <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
                <label >@lang('trans.discount') <span class="h4">%</span></label>
                <input value="{{ $Product->discount_value }}" id="discount" type="number" step="any" min="0" max="100" name="discount_value" placeholder="@lang('trans.discount')" class="form-control">
            </div>
            <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
                <label >@lang('trans.discount_from')</label>
                <input value="{{ $Product->discount_from }}" id="discount_from" type="datetime-local" name="discount_from" placeholder="@lang('trans.discount_from')" class="form-control">
            </div>
            <div class="col-md-6 discount {{  $Product->discount_value <= 0 ? 'hide' : '' }}">
                <label >@lang('trans.discount_to')</label>
                <input value="{{ $Product->discount_to }}" id="discount_to" type="datetime-local" name="discount_to" placeholder="@lang('trans.discount_to')" class="form-control">
            </div>



            <hr style="color: transparent">

{{--            <div class="col-md-6">--}}
{{--                <label for="header" class="form-label">@lang('trans.header')</label>--}}
{{--                <input class="form-control" name="header" type="file">--}}
{{--            </div>--}}

{{--            <div class="col-md-6 d-flex justify-content-center">--}}
{{--                <div class="position-relative" style="width: fit-content;">--}}
{{--                    @isset ($Product->Gallery[0])--}}
{{--                        @if(IsVideo($Product->Gallery[0]))--}}
{{--                            <video class="preview_image" src="{{ asset($Product->Gallery[0]->image) }}" autoplay /></video>--}}
{{--                        @else--}}
{{--                            <img class="preview_image" src="{{ asset($Product->Gallery[0]->image) }}" />--}}
{{--                        @endif--}}
{{--                    @endisset--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            <hr style="color: transparent">--}}

{{--            <div class="col-md-6">--}}
{{--                <label >@lang('trans.Gallery')</label>--}}
{{--                <input class="form-control"  accept="image/jpg, image/png, image/gif, image/jpeg,  image/webp, image/avif" multiple type="file" name="gallery[]">--}}
{{--            </div>--}}
{{--            <div class="row d-flex justify-content-center my-2">--}}

{{--            </div>--}}
{{--            <div class="row d-flex justify-content-center my-2">--}}
{{--                @foreach ($Product->Gallery->whereNull('color_id') as $index => $item)--}}
{{--                    @if ($item->image)--}}
{{--                        <div class="position-relative" style="width: fit-content; ">--}}
{{--                            <input type="hidden" name="old_gallery[]" value="{{ $item->image }}">--}}
{{--                            <img class="preview_image" src="{{ $item->image }}" style="max-width: 100px; {{ $index === 0 ? 'display: none;' : '' }}" />--}}
{{--                            <i data-path="{{ $item->image }}" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px; {{ $index === 0 ? 'display: none;' : '' }}"></i>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}


{{--            <hr style="color: transparent">--}}

{{--            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">--}}
{{--                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">--}}
{{--                    <h2 >@lang('trans.items')</h2>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--            @forelse($Product->Items as $Item)--}}
{{--            <div class="row items_block position-relative my-3">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>@lang("trans.color")</label>--}}
{{--                        <select class="form-control" id="items[color_id]" name="colorIds[]" multiple>--}}
{{--                            @foreach(Colors() as $color)--}}
{{--                                @php--}}
{{--                                    $isSelected = false;--}}
{{--                                    foreach($ProductItems as $item) {--}}
{{--                                        if ($item['item_id'] == $color['id'] && $item['item_type'] == 'color') {--}}
{{--                                            $isSelected = true;--}}
{{--                                            break;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                <option value="{{ $color['id'] }}" @if($isSelected) selected @endif>{{ $color->title() }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <label>@lang("trans.size")</label>--}}
{{--                        <select class="form-control" id="items[size_id]" name="sizeIds[]" multiple>--}}
{{--                            @foreach(Sizes() as $size)--}}
{{--                                @if($size->parent_id==null)--}}
{{--                                @php--}}
{{--                                    $isSelected = false;--}}
{{--                                    foreach($ProductItems as $item) {--}}
{{--                                        if ($item['item_id'] == $size['id'] && $item['item_type'] == 'size') {--}}
{{--                                            $isSelected = true;--}}
{{--                                            break;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                @endphp--}}

{{--                                <option value="{{ $size['id'] }}" @if($isSelected) selected @endif>{{ $size->title }}</option>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                @empty--}}
{{--                <div class="col-md-6 justify-content-center">--}}
{{--                    <label class="form-label">@lang('trans.color')</label>--}}
{{--                    <select class="form-control" id="size_id" name="color_id">--}}
{{--                        <option value="" selected disabled hidden>----------</option>--}}
{{--                        @foreach (Colors() as $Item)--}}
{{--                            <option value="{{ $Item->id }}">{{ $Item->title() }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 justify-content-center">--}}
{{--                        <label class="form-label">@lang('trans.size')</label>--}}
{{--                        <select class="form-control" id="color_id" name="size_id">--}}
{{--                            <option value="" selected disabled hidden>----------</option>--}}
{{--                            @foreach (Sizes() as $Item)--}}
{{--                                @if($Item->parent_id==null)--}}
{{--                                    <option value="{{ $Item->id }}">{{ $Item->title }}</option>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--            @endforelse--}}


            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.items')</h2>
                </span>
            </div>
            <div id="items_container" class="">
                @foreach($Product->Items as $item)
                    <div class="item row p-2 row items_block position-relative my-3 border border-dark">
                        <div class="col-md-6">
                            <label>@lang('trans.color'):</label>
                            <select name="colors[]" class="form-control" required>
                                <option value="">@lang('trans.Select')</option>
                                @foreach(Colors() as $color)
                                    <option value="{{ $color->id }}" {{ $color->id == $item->color_id ? 'selected' : '' }}>
                                        {{ $color['title_'.lang()] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>@lang('trans.parent') (@lang('trans.size')):</label>
                            <select name="parent_sizes[]" class="form-control" required onchange="loadSubSizes(this)">
                                <option value="">@lang('trans.Select')</option>
                                @foreach(Sizes() as $size)
                                    <option value="{{ $size->id }}" {{ $size->id == $item->parent_size_id ? 'selected' : '' }}>
                                        {{ $size->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>@lang('trans.category') (@lang('trans.size')):</label>
                            <select name="sub_sizes[]" class="form-control" required>
                                @foreach(subSizes() as $size)
                                    <option value="">____</option>
                                    @if($size->parent_id == $item->parent_size_id)
                                        <option value="{{ $size->id }}" {{ $size->id == $item->size_id ? 'selected' : '' }}>
                                            {{ $size->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="quantity">@lang('trans.quantity')</label>
                            <input type="number" min="1" name="quantity[]" value="{{ $item->quantity }}" required placeholder="@lang('trans.quantity')" class="form-control">
                        </div>
                        <button class="btn btn-danger position-absolute remove_items text-center mx-auto" style="width: 35px;{{ lang("en") ? "right" : "left" }}: 0px;top: 40%;" type="button">-</button>
                    </div>
                @endforeach
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
                <select class="form-control selectpicker" data-live-search="true" id="parent_id" name="categoryParent_id">
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
                @foreach ($Product->Categories as $Category)
                    <div class="position-relative" style="width: fit-content;"><input name="categories[]" type="hidden" value="{{ $Category->id }}">
                        {{--                    <button type="button" class="btn btn-dark">{{ $Category->Parent->title() }} -> {{ $Category->title() }}</button>--}}
                        <button type="button" class="btn btn-dark"> {{ $Category->title() }}</button>
                        <i data-path="" class="position-absolute cursor-pointer fa-regular fa-circle-xmark text-danger" style="right:0px"></i>
                    </div>
                @endforeach
            </div>


            <div class="my-3" style="width: 100%; height: 20px; border-bottom: 1px solid black; text-align: center">
                <span style="font-size: 15px; background-color: #fff; padding: 0 10px;">
                    <h2 >@lang('trans.leather')</h2>
                </span>
            </div>
            <div class="col-md-6">
                <label class="form-label d-block">@lang('trans.leather')</label>
                <div class="d-block">
                    <input type="radio" name="material" value="1" {{$Product->material == 1 ? 'checked' : ''}}> @lang('trans.exotic_leather')
                </div>
                <div class="d-block">
                    <input type="radio" name="material" value="2" {{$Product->material == 2 ? 'checked' : ''}}> @lang('trans.non_exotic_leather')
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
                    <textarea name="long_desc_ar">{!! $Product->long_desc_ar !!}</textarea>
                </div>

                <div class="col-md-6 justify-content-center">
                    <label class="form-label">@lang('trans.description_en')</label>
                    <textarea name="long_desc_en">{!! $Product->long_desc_en !!}</textarea>
                </div>
            </div>


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
        features_i = 9999;
        items_i = 9999;
        $(".selectpicker").selectpicker();
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


        {{--$(document).on('click', '.add_items', function() {--}}
        {{--    $('<div class="row items_block position-relative my-3 border border-dark">'+--}}
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

        {{--    features_i++;--}}
        {{--});--}}
        // $(document).on('click', '.remove_items', function() {
        //     $(this).parent().remove();
        // });


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
                            console.log(Category['id']);
                            $('select#category_id').append('<option data-parent="' + Category['parent']['title_{{ lang() }}'] + '" value="' + Category['id'] + '">' + Category['title_{{ lang() }}'] + '</option>');
                        }
                    });
                }
            });
            $(".selectpicker").selectpicker('refresh');
        }
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
