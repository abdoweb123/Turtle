@extends('Admin.layout')

@section('pagetitle', __('trans.products'))
@section('content')


<div class="row">
    <div class="col-12">
        @error('ExistCodes')
            <div class="alert alert-danger mt-4">
                <ul>
                    <h3>Error, code`s must be unique</h3>
                    <div class="row">
                        @foreach($errors->get('ExistCodes') as $code)
                            <div class="col-3">{{ $code }}</div>
                        @endforeach
                    </div>
                </ul>
            </div>
        @enderror
    </div>
</div>
<div class="row">

    <div class="my-2 col-md-3">
        <a href="{{ route('admin.products.create') }}" class="main-btn">@lang('trans.add_new')</a>
    </div>
    <div class="my-2 col-md-3">
        <div>
            <button type="button" id="DeleteSelected" onclick="DeleteSelected('products')" class="btn btn-danger" disabled>@lang('trans.Delete_Selected')</button>
        </div>
    </div>
    <div class="my-2 col-md-6">
        <form method="post" action="{{ route('admin.import_products') }}"  enctype="multipart/form-data">
    
            <div class="row">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    @csrf
                    <a download href="{{ asset('sample.xlsx') }}" class="px-1"><i class="fa-solid fa-download"></i></a>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <div class="col-6">
                    <button type="submit" class="main-btn px-5">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>



<table class="table table-bordered data-table" >
    <thead>
        <tr>
            <th><input type="checkbox" id="ToggleSelectAll" class="main-btn"></th>
            <th>@lang('trans.price')</th>
            <th>@lang('trans.title')</th>
            <th>@lang('trans.most_popular')</th>
            <th>@lang('trans.ranking')</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($Products as $Model)
        <tr>
            <td>
                <input type="checkbox" class="DTcheckbox" value="{{ $Model->id }}">   {{ $loop->iteration }}
            </td>
            <td>@if ($Model->HasDiscount()) <small class="text-danger" style="text-decoration: line-through">{{ $Model->Price() }}</small> @endif <h5 class="mx-1">{{ $Model->CalcPriceWithCurrancy() }}</h5></td>
            <td><a href="{{ route('admin.products.show', $Model) }}">{{ $Model->title() }}</a></td>
            <td>
                <div class="form-check form-switch">
                    <input
                            type="checkbox"
                            class="form-check-input"
                            id="statusSwitch{{ $Model->id }}"
                            {{ $Model->most_popular == 1 ? 'checked' : '' }}
                            data-product-id="{{ $Model->id }}"
                            style="width:45%; height:25px; display:block; margin:auto"
                    >
                    <label class="form-check-label" for="statusSwitch{{ $Model->id }}"></label>
                </div>
            </td>
            <td>
                <input type="number" name="order[{{ $Model->id }}]" value="{{ $Model->order }}" class="form-control order-input" style="width: 60px;">
            </td>
            <td>
                <a href="{{ route('admin.products.gallery', ['product_id'=>$Model]) }}"><i class="fa-regular fa-images"></i></a>
{{--                <a href="{{ route('admin.products.getSizes', ['product_id'=>$Model]) }}"><i class="fas fa-ruler"></i></a>--}}
                <a href="{{ route('admin.products.edit', $Model) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                <form class="formDelete" method="POST" action="{{ route('admin.products.destroy', $Model) }}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                        <i class="fa-solid fa-eraser"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection



@section('js')
    <script>
        // Function to toggle status via Ajax
        function toggleStatus(productId) {
            $.ajax({
                url: 'products/change-most-popular/' + productId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    // Update the UI or handle the response as needed
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Attach event listener to the switch
        $('.form-check-input').on('change', function () {
            var productId = $(this).data('product-id');
            toggleStatus(productId);
            console.log(productId);
        });


        // update ranking
        document.addEventListener('DOMContentLoaded', function() {
            const orderInputs = document.querySelectorAll('.order-input');

            orderInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const orderData = {};

                    orderInputs.forEach(input => {
                        orderData[input.name.replace('order[', '').replace(']', '')] = input.value;
                    });

                    fetch('{{ route('admin.products.updateOrder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: orderData })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    text: '{{ __('trans.updatedSuccessfully') }}',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 500, // 1 second
                                    timerProgressBar: true,
                                });
                            }
                        });
                });
            });
        });
    </script>
@stop