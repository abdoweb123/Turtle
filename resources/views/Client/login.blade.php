@extends('Client.Layout.index')

@section('title')
  @lang('trans.login')
@stop


@section('style')
  <style>
    .form-check .form-check-input {
       margin-left: 0;
    }

    .toggle-password{
      float:{{lang()=='ar'? 'left' : 'right'}}
    }

    #country_code{
      {{lang() == 'en' ? ' padding-right: ' : 'padding-left: '}} 10px !important;
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
      <div class="col-md-6 d-flex mx-auto flex-column">
        <form action="{{route('Client.login')}}" class="d-flex flex-column justify-content-center align-items-center" method="POST">
          @csrf
          <h4 class="text-danger col-10 fw-semibold">@lang('trans.login')</h4>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.username_or_email_address') <span class="red-label">*</span>
            </label>
            <input type="text" class="form-control rounded-0" name="username_or_email" placeholder="@lang('trans.username_or_email_address')" required>
          </div>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.password') <span class="red-label">*</span>
            </label>
            <input type="password" class="form-control rounded-0" name="password" placeholder="@lang('trans.password')" id="current-password" required>
            <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
          </div>
            <div class="form-check d-flex justify-content-end mt-2 text-secondary col-10">
                <input class="form-check-input" type="checkbox"  name="remember" id="flexCheckDefault">
                <label class="form-check-label mx-2" for="flexCheckDefault">
                    @lang('trans.remember')
                </label>
            </div>
          <div class="mt-4 col-10">
            <button type="submit" class="btn btn-info rounded-0 col-12">@lang('trans.login')</button>
          </div>
          <div class="mt-2 col-10">
            <a href="{{route('Client.password_request')}}" class="text-decoration-none text-secondary">  @lang('trans.forget_password')</a>
          </div>
        </form>
      </div>

      <div class="col-md-6 mt-5 mt-md-0 d-flex justify-content-start mx-auto flex-column {{lang()=='ar'? 'border-end':'border-start'}} d-flex ">
        <form action="{{route('Client.register')}}" class="d-flex flex-column justify-content-center align-items-center" method="post">
         @csrf
          <h4 class="text-danger col-10 fw-semibold">@lang('trans.register')</h4>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.name') <span class="red-label">*</span>
            </label>
            <input type="text" class="form-control rounded-0" name="name" placeholder="@lang('trans.name')" required>
          </div>

          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.phone') <span class="red-label">*</span>
            </label>
            <input type="text" class="form-control rounded-0" placeholder="Ex: 973 32188288" name="phone" required>
          </div>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.email_address') <span class="red-label">*</span>
            </label>
            <input type="email" class="form-control rounded-0" name="email" placeholder="@lang('trans.email_address')" required>
          </div>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.password') <span class="red-label">*</span>
            </label>
            <input type="password" class="form-control rounded-0" name="password" id="password" placeholder="@lang('trans.password')" required>
            <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
          </div>
          <div class="mt-4 col-10">
            <label for="" class="text-secondary">@lang('trans.confirmPassword') <span class="red-label">*</span>
            </label>
            <input type="password" name="password_confirmation" class="form-control rounded-0" placeholder="@lang('trans.confirmPassword')" required>
            <i class="toggle-password fa fa-fw fa-eye mx-3"></i>
          </div>
          <div class="d-flex flex-column col-10">
{{--            <span class="text-secondary fs-7 mt-2">@lang('trans.link_to_sent_email')</span>--}}
            <span class="text-secondary fs-7 mt-3">
              @lang('trans.privacy_policy_desc')
              <a href="{{route('Client.privacy')}}" class="text-decoration-none fw-semibold">@lang('trans.privacy_policy')</a>
            </span>
          </div>
          <div class="mt-4 col-10">
            <button type="submit" class="btn btn-info rounded-0 col-12">@lang('trans.register')</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@stop

@section('script')
  <!-- to toggle password -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var togglePasswords = document.querySelectorAll('.toggle-password');

      togglePasswords.forEach(function(icon) {
        icon.addEventListener('click', function() {
          var passwordInput = this.parentElement.querySelector('input[type="password"]'); // Get the password input within the same parent element
          passwordInput.classList.toggle('show-password');
          this.querySelector('i').classList.toggle('fa-eye-slash');
        });
      });
    });
  </script>
@stop