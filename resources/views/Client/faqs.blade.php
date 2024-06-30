@extends('Client.Layout.index')

@section('title')
  @lang('faq')
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


  <!-- start FAQ -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="mt-5 mb-5">
            <h3 class="text-center">@lang('trans.faq')</h3>
          </div>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach($Faqs as $faq)
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed text-info fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_{{$faq->id}}" aria-expanded="false" aria-controls="flush-collapse_{{$faq->id}}">
                    {{$faq['question_'.lang()]}}
                  </button>
                </h2>
                <div id="flush-collapse_{{$faq->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    {{$faq['answer_'.lang()]}}
                  </div>
                </div>
              </div>
              <div class="hr"></div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end FAQ -->
@stop