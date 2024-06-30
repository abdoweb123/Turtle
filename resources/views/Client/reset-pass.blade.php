@extends('Client.Layout.index')

@section('title')
  @lang('trans.my_account')
@stop


@section('style')
  <style>
    .form-check .form-check-input {
      margin-left: 0;
    }

    .toggle-password{
      float:{{lang()=='ar'? 'left' : 'right'}}
    }
  </style>
@stop


@section('content')
<!------------ header ------------>
  <header class="header overflow-hidden bg-primary">
  <!-- header navbar -->
  @include('Client.Layout.MainNavigation')
  <!-- header content -->
  <div class="container py-md-4">
    <section class="row d-flex align-items-center justify-content-center flex-md-row pb-3">
      <!-- content >> text -->
      <div class="col-md-12 col-sm-12">
        <div class="py-6"></div>
      </div>
    </section>
  </div>
  </header>
<!------------ header end ------------>


<!-- start My Account -->
<section class="py-3 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between">
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
    <div class="row">
      <div class="col-md-12">
        <form method="POST" action="{{ route('Client.password_update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}">
          <span class="text-secondary">@lang('trans.enter_new_password_below').</span>
          <div class="mt-4 row"> 
            <div class="col-md-6 inp-pass"> 
              <label for="" class="text-secondary">@lang('trans.new_password')
                <span class="red-label">*</span> 
              </label>
              <input type="password" class="form-control rounded-0" name="password" placeholder="" id="current-password">
              <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
            </div>
            <div class="col-md-6 inp-pass"> 
              <label for="" class="text-secondary">@lang('trans.new_password_confirmation')
                <span class="red-label">*</span> 
              </label>
              <input type="password" class="form-control rounded-0" name="password_confirmation" placeholder="" id="current-password">
              <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-info rounded-0 px-3 py-1">@lang('trans.save') </button>
          </div>
        </form>
      </div>
    </div>
    
  </div>
</section>

@stop

@section('script')

@stop