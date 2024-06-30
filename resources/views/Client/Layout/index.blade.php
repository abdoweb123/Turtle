<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

@yield('js_above')

<!-- CSS Files -->
  <!-- bootstrap css file -->
  <link rel="stylesheet" href="{{asset('assets_client/css/bootstrap.css')}}" />
  <!-- bootstrap-icon css file -->
  <link rel="stylesheet" href="{{asset('assets_client/bootstrap-icon/bootstrap-icons.css')}}">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- animation library css file -->
  <link rel="stylesheet" href="{{asset('assets_client/aos/aos.css')}}">
  <!-- swiper css file -->
  <link rel="stylesheet" href="{{asset('assets_client/swiper/swiper-bundle.min.css')}}">
  <!--====== Slick css ======-->
  <link rel="stylesheet" href="{{asset('assets_client/css/slick.css')}}">
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{asset('assets_client/css/style.css')}}" />
  <!-- include Navbar , Footer and Sidebar -->
  <script src="{{asset('assets_client/js/renderPageLayout.js')}}"></script>
  <!-- favicon -->
  <link rel="icon" href="{{asset('assets_client/images/WhatsApp Image 2024-02-25 at 11.png')}}">
  <!-- font cairo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
  @yield('link')

  <style>
    @if(lang() == 'ar')
        body{direction: rtl}
    .slick-track{
      float:left;
    }
    @else
        body{direction: ltr}
    @endif

      .mega-sub-menu{
      left: initial;
      margin: auto;
      min-width: 200px;
      width: inherit !important;
    }

    /*@media only screen and (min-width: 1300px)*/
    /*{*/
    /*  .mega-sub-menu {*/
    /*     width: inherit !important;*/
    /*  }*/
    /*}*/

    .swal2-popup .swal2-styled.swal2-confirm,
    .swal2-popup .swal2-styled.swal2-confirm:focus{
      background-color: {{setting('main_color')}} !important;
      border: none !important;
      outline: none !important;
      box-shadow: none;
    }
    :root {
      --swiper-theme-color: {{setting('main_color')}} !important;
    }


    body {
      font-family: 'Cairo', sans-serif;
    }

    .search_product:focus {
      border:none !important;
    }
  </style>

  @yield('style')

{{--  <title>{{setting('title_'.lang())}} - @yield('title')</title>--}}
  @if(Request::is('/'))
    <title>@lang('trans.Turtle_for_shoes')</title>
  @else
    <title>{{ setting('title_'.lang()) }} - @yield('title')</title>
  @endif

  <meta name="description" content="Turtle is your one-stop shop for trendy footwear, accessories, and eyewear for all ages. Explore our wide range of products and enjoy convenient shopping with international standards. We are dedicated to providing a secure and enjoyable shopping experience, ensuring the highest levels of quality and customer satisfaction.">
  <meta name="keywords" content="Turtle, footwear, accessories, eyewear, online shopping, international standards, secure shopping, quality products, customer satisfaction">
  <meta name="author" content="Turtle">
  <meta name="image" content="https://turtle.com/turtle.jpg">
  <meta property="og:title" content="Turtle">
  <meta property="og:description" content="Turtle is your one-stop shop for trendy footwear, accessories, and eyewear for all ages. Explore our wide range of products and enjoy convenient shopping with international standards. We are dedicated to providing a secure and enjoyable shopping experience, ensuring the highest levels of quality and customer satisfaction.">
  <meta property="og:locale" content="en">
  <meta property="og:image" content="https://turtle.com/turtle.webp">
  <meta property="og:url" content="https://yourwebsite.com/turtle">
  <meta property="og:site_name" content="Turtle">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://yourwebsite.com/turtle.jpg">
  <meta name="twitter:card" content="Turtle">
  <meta name="twitter:title" content="Turtle">
  <meta name="twitter:description" content="Turtle is your one-stop shop for trendy footwear, accessories, and eyewear for all ages. Explore our wide range of products and enjoy convenient shopping with international standards. We are dedicated to providing a secure and enjoyable shopping experience, ensuring the highest levels of quality and customer satisfaction.">
  <meta name="twitter:image" content="https://yourwebsite.com/turtle.jpg">
  <meta name="twitter:site" content="@Turtle">
  <meta name="csrf-token" content="djWcZyFkkEDn0x4JMYgGnKOSsJOWwwb8YO6jGiri">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="orJ7ZbMHiPkMYkLCmiZpVFPHiWeJYzxBdmYrqe4q-0E" />
  <meta content='max-age=604800' http-equiv='Cache-Control'/>
  <include expiration='7d' path='*.css'/>
  <include expiration='7d' path='*.js'/>
  <include expiration='3d' path='*.gif'/>
  <include expiration='3d' path='*.jpeg'/>
  <include expiration='3d' path='*.jpg'/>
  <include expiration='3d' path='*.png'/>
  <include expiration='3d' path='*.webp'/>
  <include expiration='3d' path='*.ico'/>

  <meta name="description" content="تيرتل هو متجرك الشامل للأحذية العصرية والإكسسوارات والنظارات لجميع الأعمار. استكشف مجموعتنا الواسعة من المنتجات واستمتع بالتسوق المريح مع المعايير الدولية. نحن ملتزمون بتوفير تجربة تسوق آمنة وممتعة، وضمان أعلى مستويات الجودة ورضا العملاء.">
  <meta name="keywords" content="تيرتل، أحذية، إكسسوارات، نظارات، التسوق عبر الإنترنت، المعايير الدولية، التسوق الآمن، منتجات عالية الجودة، رضا العملاء">
  <meta name="author" content="تيرتل">
  <meta name="image" content="https://turtle.com/turtle.jpg">
  <meta property="og:title" content="تيرتل">
  <meta property="og:description" content="تيرتل هو متجرك الشامل للأحذية العصرية والإكسسوارات والنظارات لجميع الأعمار. استكشف مجموعتنا الواسعة من المنتجات واستمتع بالتسوق المريح مع المعايير الدولية. نحن ملتزمون بتوفير تجربة تسوق آمنة وممتعة، وضمان أعلى مستويات الجودة ورضا العملاء.">
  <meta property="og:locale" content="en">
  <meta property="og:image" content="https://turtle.com/turtle.webp">
  <meta property="og:url" content="https://yourwebsite.com/turtle">
  <meta property="og:site_name" content="تيرتل">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://yourwebsite.com/turtle.jpg">
  <meta name="twitter:card" content="تيرتل">
  <meta name="twitter:title" content="تيرتل">
  <meta name="twitter:description" content="تيرتل هو متجرك الشامل للأحذية العصرية والإكسسوارات والنظارات لجميع الأعمار. استكشف مجموعتنا الواسعة من المنتجات واستمتع بالتسوق المريح مع المعايير الدولية. نحن ملتزمون بتوفير تجربة تسوق آمنة وممتعة، وضمان أعلى مستويات الجودة ورضا العملاء.">
  <meta name="twitter:image" content="https://yourwebsite.com/turtle.jpg">
  <meta name="twitter:site" content="@تيرتل">
  <meta name="csrf-token" content="djWcZyFkkEDn0x4JMYgGnKOSsJOWwwb8YO6jGiri">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="google-site-verification" content="orJ7ZbMHiPkMYkLCmiZpVFPHiWeJYzxBdmYrqe4q-0E" />
  <meta content='max-age=604800' http-equiv='Cache-Control'/>
  <include expiration='7d' path='*.css'/>
  <include expiration='7d' path='*.js'/>
  <include expiration='3d' path='*.gif'/>
  <include expiration='3d' path='*.jpeg'/>
  <include expiration='3d' path='*.jpg'/>
  <include expiration='3d' path='*.png'/>
  <include expiration='3d' path='*.webp'/>
  <include expiration='3d' path='*.ico'/>

</head>
<body>

<!-- For Errors -->
@if($errors->any())
  <div class="position-fixed end-0" style="top: 25%;z-index: 1111">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger">
        {{$error}}
      </div>
    @endforeach
  </div>
@endif


@yield('content')


<!------- start footer ------------>
@include('Client.Layout.MainFooter')
<!------- end footer ------------>

<!--========= start sidebar  =========-->
@include('Client.Layout.includeSidebar')
<!--========= end sidebar  =========-->

<!--====== BACK TO TP PART START ======-->
<a href="tel:{{Branches()->first()->Country->phone_code.Branches()->first()['phone']}}"
   class="btn-phone btn btn-info text-white rounded-circle py-2 px-2"
>
  <i class="fa-solid fa-phone"></i></a>
<a href="https://wa.me/{{Branches()->first()->Country->phone_code.Branches()->first()['phone']}}" class="whats-app btn btn-info py-2 px-2 rounded-circle" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Whatsapp">
  <i class="bi bi-whatsapp my-float"></i>
</a>

<!--====== BACK TO TP PART ENDS ======-->

<!-- JS Files -->
<!-- animation library js file -->
<script src="{{asset('assets_client/aos/aos.js')}}"></script>
<!-- bootstrap js file -->
<script src="{{asset('assets_client/js/bootstrap.bundle.min.js')}}"></script>
<!-- swiper js file -->
<script src="{{asset('assets_client/swiper/swiper-bundle.min.js')}}"></script>
<!-- main js file -->
<script src="{{asset('assets_client/js/script.js')}}"></script>
<!--====== Slick js ======-->
<script src="{{asset('assets_client/js/slick.min.js')}}"></script>
<script src="{{asset('assets_client/js/slick.js')}}"></script>

<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  // Get the data passed from the session
  var success = {!! json_encode(session('success')) !!};
  var type = {!! json_encode(session('type')) !!};
  var message = {!! json_encode(session('message')) !!};
  var cart_count = {!! json_encode(session('cart_count')) !!};

  let textMessage = '';
  // Check if cart_count is not empty
  if (cart_count) {
    // If cart_count is not empty, concatenate it with the label
    textMessage = '@lang('trans.cart_count')' + ' : ' + cart_count;
  } else {
    // If cart_count is empty, display a different message
    textMessage = '';
  }

  // Display SweetAlert based on the session data
  if (success) {
    Swal.fire({
      icon: type,
      title: message,
      text: textMessage,
      showConfirmButton: true,
      // timer: 1500 // Display duration in milliseconds
    });
  }
</script>

<!-- Start Add tostr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  // Check if there are any toast messages from the backend
  @if(session('toast_message'))
  // Display the toast message using Toastr
  toastr.{{ session('toast_message')['type'] }}('{{ session('toast_message')['message'] }}');
  @endif
</script>
<!-- End Add tostr -->

<!-- Start toggle product to wishlist -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function() {
    $('#subscribeButton').click(function(e) {
      e.preventDefault();

      var email = $('#emailInput').val();

      $.ajax({
        type: "POST",
        url: "{{ route('Client.subscribe') }}",
        data: {
          email: email,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          // If success, clear input field and show success message
          $('#emailInput').val('');
          Swal.fire({
            icon: 'success',
            title: '{{ __("trans.subscribedSuccessfully") }}',
            showConfirmButton: false,
            timer: 1500
          });
        },
        error: function(xhr, status, error) {
          // If error, show error message
          Swal.fire({
            icon: 'error',
            text: xhr.responseJSON.message
          });
        }
      });
    });

    // To close modal not_authenticate_yet
    $('.not_authenticate_yet .btn-close').on('click', function() {
      $('.not_authenticate_yet').hide();
      $('.size-select').removeClass('selected-img');
      $('.img-container img').removeClass('selected-img');
      $('input[name="color_id"]').val('');
      $('input[name="size_id"]').val('');
      $('#addToCart').addClass('disabled-btn');
      $('.in-stock-button').hide();
      $('.out-stock-button').hide();
    });

    // handle Heart Click
    $('.heartIcon').on('click', function(e) {
      e.preventDefault(); // Prevent default link behavior

      // To check if authenticated
      var checkAuth = "{{ auth('client')->check() ? '1' : '0' }}";
      if (checkAuth !== '1') {
        $('.not_authenticate_yet').fadeIn().addClass('show_not_authenticate_yet');
        return;
      }


      var $heartIcon = $(this);
      var productId = $heartIcon.data('product-id');
      var actionUrl = $heartIcon.data('action-url');
      var $spinner = $heartIcon.prev('.spinner');

      // Show spinner and hide heartIcon
      $spinner.show();
      $heartIcon.hide();

      // Perform AJAX request
      $.ajax({
        url: actionUrl,
        method: 'POST',
        data: {
          product_id: productId,
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          // Hide spinner and show heartIcon upon success
          $spinner.hide();

          if (response.exists === 1){
            $heartIcon.removeClass().addClass('fa-solid fa-heart position-absolute heartIcon text-info');
          }
          else {
            $heartIcon.removeClass().addClass('fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon');
          }

          $heartIcon.show();

          // Show success message with SweetAlert
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
          // Handle error
          console.error(error);

          // Hide spinner and show heartIcon upon error
          $spinner.hide();
          // $heartIcon.removeClass().addClass('fa-solid fa-heart position-absolute heartIcon text-info');
          $heartIcon.show();

          swal.fire({
            title: "Error!",
            text: "An error occurred. Please try again later.",
            icon: "error",
          });
        }
      });
    });
  });
</script>
<!-- End toggle product to wishlist -->

<!-- Start search -->
<script>
  var typingTimer;
  var doneTypingInterval = 500; // milliseconds

  $('.search_product').on('keyup', function () {
    var $this = $(this);
    clearTimeout(typingTimer);
    if ($this.val()) {
      typingTimer = setTimeout(function () {
        doneTyping($this);
      }, doneTypingInterval);
    }
  });

  function doneTyping($input) {
    var searchTerm = $input.val();
    if (searchTerm) {
      $.ajax({
        url: '{{route('Client.searchProducts')}}',
        type: 'GET',
        data: { search_product: searchTerm },
        success: function (response) {
          displayResults($input, response);
        }
      });
    }
  }

  function displayResults($input, products) {
    var $resultsList = $('.search_results');
    console.log($resultsList);
    $resultsList.empty();
    var productDetailsRoute = $input.data('product-details-route'); // Get the route from data attribute
    if (products.length > 0) {
      $.each(products, function (index, product) {
        $resultsList.append('<li style="list-style-type: none;"><a style="text-decoration: none" href="' + productDetailsRoute + '/' + product.id + '">' + product.title + '</a></li>');
      });
      $resultsList.show();
      $resultsList.css('padding-top','15px');
    } else {
      $resultsList.hide();
      $resultsList.css('padding-top','0');
    }
  }

  // Hide the results list when clicking outside the input field
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.search_results').length && !$(e.target).is('.search_product')) {
      $('.search_results').hide();
    }
  });

</script>
<!-- End search -->

@yield('script')
</body>
</html>

