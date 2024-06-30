@extends('Client.Layout.index')

@section('title')
  @lang('trans.Terms and Conditions')
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


<!-- start terms-conditions -->
<section class="py-5 border-bottom">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="">@lang('trans.Terms and Conditions')</h3>
        <div>
          {!! nl2br(Setting('terms_'.lang())) !!}
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end terms-conditions -->
@stop