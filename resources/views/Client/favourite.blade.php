@extends('Client.Layout.index')


@section('title')
    @lang('trans.myFavourite')
@stop


@section('style')
    <style>
        .out-stock-danger{
            color: red;
        }
    </style>
@stop

@section('content')
<!------------ header ------------>
@include('Client.Layout.header')
<!------------ header end ------------>

<section class="py-5 border-bottom">
  <div class="container">
    <section class="py-4">
      <div class="container">
      <div class="card-body p-0 table-responsive">
        <table class="table border">
          <thead>
              <tr>
                  <th class="text-center" style="white-space:nowrap">@lang('trans.image')</th>
                  <th class="text-center" style="white-space:nowrap">@lang('trans.Product Name')</th>
                  <th class="text-center" style="white-space:nowrap">@lang('trans.stockStatus')</th>
                  <th class="text-center" style="white-space:nowrap">@lang('trans.unit_price')</th>
                  <th class="text-center" style="white-space:nowrap">@lang('trans.delete')</th>
                  <th class="text-center" style="white-space:nowrap"></th>
              </tr>
          </thead>
          <tbody>
              @foreach($wishlist as $item)
                  <tr>
                      <td class="" style="white-space:nowrap">
                          <div class="media">
                              <a class="thumbnail pull-left" href="#">
                                  <img class="media-object" src="{{asset($item->Product->Gallery['0']['image'] ?? Setting('not_found_img'))}}" style="width: 72px; height: 72px;">
                              </a>
                          </div>
                      </td>
                      <td class="" style="white-space:nowrap">
                          <div class="media">
                              <div class="media-body mt-4 text-center">
                                  <span>{{$item->Product['title_'.lang()]}}</span>
                              </div>
                          </div>
                      </td>
                      <td class="text-center" style="white-space:nowrap">
                          <div class="mt-4">
                              @if($item->Product->quantity > 0)
                                  <span class="stock-text">@lang('trans.inStock')</span>
                              @else
                                  <span class="out-stock-danger">@lang('trans.outStock')</span>
                              @endif
                          </div>
                      </td>
                      <td class="text-center" style="white-space:nowrap">
                          <div class="mt-4">
                              @if($item->Product->HasDiscount())
                                  <span style="text-decoration: line-through; {{lang() == 'en' ? 'margin-right' : 'margin-left'}}: 10px;">
                                    {{$item->Product->Price()}}
                                </span>
                                  <span>{{$item->Product->PriceWithCurrancy()}}</span>
                              @else
                                  <span>{{$item->Product->RealPrice()}}</span> {{Country()->currancy_code}}
                              @endif
                          </div>
                      </td>
                      <td class="" style="white-space:nowrap">
                          <div class="mt-4 text-center">
                              <img class="spinner" src="{{ asset('assets_client/images/spinner.png') }}" width="15" height="15" style="right:0; display: none;"></span>
                              <i class="fa-solid fa-trash cursor-pointer text-primary" onclick="deleteRow(this,{{$item->Product->id}})"></i>
                          </div>
                      </td>
                      <td class="" style="white-space:nowrap">
                          <div class="mt-4 text-center">
                              <a href="{{route('Client.productDetails',$item->product_id)}}" class="btn btn-info rounded-1 fs-7 px-3 py-1" >@lang('trans.product_details')</a>
                          </div>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      
    
      
  
      </div>
      </div>
    </section>
  </div>
</section>
@stop


@section('script')
<script>


    function deleteRow(element, id) {

        $(element).hide();
        $(element).prev('.spinner').show();

        // Send AJAX request
        $.ajax({
            url: '{{route('Client.deleteWishlist')}}', // URL to your delete route
            type: 'POST',
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                // Handle success response
                $(element).closest('tr').remove(); // Remove the row from the table
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    showConfirmButton: true,
                    timer: 1500
                });
                $('.fa-heart .icon-number').text(response.wishlistCount);
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('Error deleting row: ' + error);
            }
        });
    }

</script>
@stop