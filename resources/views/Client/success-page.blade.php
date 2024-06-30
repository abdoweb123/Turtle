@extends('Client.Layout.index')

@section('title')
  {{env('APP_NAME')}}
@stop

@section('content')
<!------------ header ------------>
@include('Client.Layout.header')
<!------------ header end ------------>


<section class="py-5">
  <div class="container">
      <!-- start content  -->
      <div class="row d-flex align-items-center justify-content-center text-center">
        <div class="col-sm-5">
          <div>
            <img src="{{asset('assets_client/images/Frame1000002940.png')}}" alt="">
          </div>
          <h6 class="fw-semibold text-black mt-3">@lang('trans.order_send_successfully')</h6>
          <div class="text-center">
            <a href="{{route('Client.home')}}" class="btn btn-info rounded-2 col-sm-7 mb-3 mt-4">@lang('trans.back_to_home')</a>
          </div>

            @if(request()->payment_id == 1)
                <a href="https://wa.me/{{setting('whatsapp')}}" class="py-2 px-2 ">
                    @lang('trans.Contact_us_via_WhatsApp')
                </a>
            @endif
        </div>
      </div>
      <!-- end content  -->
  </div>
</section>
@stop