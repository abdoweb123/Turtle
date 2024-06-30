<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- CSS Files -->
    <!-- bootstrap css file -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- bootstrap-icon css file -->
    <link rel="stylesheet" href="Assets/bootstrap-icon/bootstrap-icons.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- animation library css file -->
    <link rel="stylesheet" href="Assets/aos/aos.css">
      <!-- swiper css file -->
      <link rel="stylesheet" href="Assets/swiper/swiper-bundle.min.css">
      <!--====== Slick css ======-->
    <link rel="stylesheet" href="css/slick.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- include Navbar , Footer and Sidebar -->
    <script src="js/renderPageLayout.js"></script>
    <!-- favicon -->
    <link rel="icon" href="images/logo.png">
    <title> Private Collection Website</title>
  </head>
  <body>

  <!------------ header ------------>
  <header class="header overflow-hidden bg-primary">
    <!-- header navbar -->
      <script>
      MainNavigation();
    </script>
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


<!-- start cart -->
<section class="py-3 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between">
          <h4 class="fw-semibold">Cart</h4>
          <div>
            <a href="" class="text-decoration-none link-info text-danger">
            <i class="fa-solid fa-house"></i>
            <span class="mx-1">Home</span></a>
            <span class="mx-1">/</span>
            <span class="mx-1">Cart</span>
          </div>
        </div>
        
              
      
      
      </div>
    </div>
  </div>
</section>
<!-- end cart -->

<section class="py-5">
  <div class="container">
    <div class="alert alert-primary blue-alert rounded-0 d-flex justify-content-between" role="alert">
      <div class="d-flex align-items-center">
        <i class="fa-solid fa-circle-exclamation fs-5"></i>
        <span class="text-white mx-2">Your cart is currently empty.</span>
      </div>
      <div class="">
        <a href="shop.blade.php" class="btn btn-light rounded-1 py-1">
          Return to Shop
        </a>
      </div>
    </div>
  </div>
</section>


  <!------- start footer ------------>
    <script>
      MainFooter();
    </script>
  <!------- end footer ------------>

  <!--========= start sidebar  =========-->
  <script>
    includeSidebar();
  </script>
  <!--========= end sidebar  =========-->

<!--====== BACK TO TP PART START ======-->
      <a href="tel:+971 553439920"
      class="btn-phone btn btn-info text-white rounded-circle py-2 px-2"
      >
      <i class="fa-solid fa-phone"></i></a>  
      <a href="https://wa.me/+97334479384" class="whats-app btn btn-info py-2 px-2 rounded-circle" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Whatsapp">
        <i class="bi bi-whatsapp my-float"></i>
      </a>  
    
<!--====== BACK TO TP PART ENDS ======-->
  

    <!-- JS Files -->
    <!-- animation library js file -->
    <script src="Assets/aos/aos.js"></script>
    <!-- bootstrap js file -->
    <script src="js/bootstrap.bundle.min.js"></script>
      <!-- swiper js file -->
    <script src="Assets/swiper/swiper-bundle.min.js"></script>
    <!-- main js file -->
    <script src="js/script.js"></script>  
    <!--====== Slick js ======-->
    <script src="js/slick.min.js"></script>
    <script src="js/slick.js"></script>
   
  </body>
</html>

