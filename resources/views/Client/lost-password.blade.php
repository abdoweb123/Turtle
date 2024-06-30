@extends('Client.Layout.index')

@section('title')
  @lang('trans.my_account')
@stop


@section('style')
  <style>
    .woocommerce .woocommerce-message {
      background: #28a745;
    }
    error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message {
      color: #fff;
      font-size: 14px;
      padding: 30px 20px;
      margin: 0;
      margin-bottom: 15px;
      border: none;
      line-height: 30px;
    }
  </style>
@stop

@section('content')
<!------------ header ------------>
  @include('Client.Layout.header')
  <!------------ header end ------------>


<!-- start My Account -->
<section class="py-3 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between mx-2">
           <h4 class="fw-semibold">@lang('trans.my_account')</h4>
          <div>
            <a href="" class="text-decoration-none link-info text-danger">
            <i class="fa-solid fa-house"></i>
            <span class="mx-1">@lang('trans.home')</span></a>
            <span class="mx-1">/</span>
            <span class="mx-1">@lang('trans.my_account')</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end My Account -->

<section class="py-5 border-bottom">
  <div class="container">

    @if(isset($success) && $success == 1)
    <div class="woocommerce">
      <div class="woocommerce-message" role="alert">
        <i class="fa fa-envelope" aria-hidden="true"></i>
       <span class="mx-2"> @lang('trans.password_reset_email_has_been_sent'). </span>
      </div>
      <p>@lang('trans.password_reset_email_has_been_sent_wait_ten_mins')</p>
    </div>
    @else
    <div class="row">
      <div class="col-md-10">
        <form action="{{route('Client.sendResetLinkEmail')}}" method="POST">
          @csrf
          <span class="text-secondary">@lang('trans.forget_password')  @lang('trans.forget_password_desc')
          </span>
          <div class="mt-4 col-md-8">
            <label for="" class="text-secondary">@lang('trans.username_or_email_address') <span class="red-label">*</span>
            </label>
            <input type="text" class="form-control rounded-0" name="nameOrEmail">
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-info rounded-0 px-3 py-1">@lang('trans.reset_password')</button>
          </div>
        </form>
      </div>
    </div>
    @endif
  </div>
</section>
@stop