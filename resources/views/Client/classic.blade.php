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


<!-- start CLASSIC -->
<section class="py-3 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between">
          <h4 class="fw-semibold">CLASSIC</h4>
          <div>
            <a href="" class="text-decoration-none link-info text-danger">
            <i class="fa-solid fa-house"></i>
            <span class="mx-1">Home</span></a>
            <span class="mx-1">/</span>
            <span class="mx-1">Products</span>
            <span class="mx-1">/</span>
            <span class="mx-1">CLASSIC</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end CLASSIC -->

<section class="py-5 border-bottom">
  <div class="container">
    <div class="row">
      <button  class="btn btn-link d-lg-none"  type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight">
        <i class="bi bi-filter-square-fill text-primary fs-1 d-flex justify-content-end p-0"></i>
      </button>
            <!--=========== start sidebar tabs =========-->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <img src="images/chemical-guys-logo.svg" alt="">
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12 rounded-1 p-4 d-block h-100">
            <!-- checks and FILTER BY CATEGORIES -->
        <div class="border-bottom"  style="max-height: 300px; overflow-y: auto;">
          <h6 class="text-danger fw-bold">FILTER BY CATEGORIES</h6>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              Arca
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              Peninsula
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              Quadratura
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              Western
            </label>
          </div>
        
          </div>
        <!-- checks and FILTER BY SIZE -->
        <div class="border-bottom mt-4"  style="max-height: 300px; overflow-y: auto;">
          <h6 class="text-danger fw-bold">FILTER BY SIZE</h6>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
            6.0 UK
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              7.0 UK
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              8.0 UK
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              8.5 UK
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              9.0 UK
            </label>
          </div>
          </div>
          <div class="mt-4">
            <h6 class="text-danger fw-bold">FILTER BY COLOR</h6>
            <div class="d-flex flex-wrap row">
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:rebeccapurple;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:gray;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:yellow;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:black;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:#41492b;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">  <span class="color-inp col-sm-2 mb-2" style="background-color:navy;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:#41492b;"></span></div>
              <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">  <span class="color-inp col-sm-2 mb-2" style="background-color:navy;"></span></div>
            </div>
            
          </div>
          <div class="border-bottom mt-3"></div>
          <!-- RECENTLY VIEWED PRODUCTS -->
          <div class="mt-4">
            <h6 class="text-danger fw-bold">RECENTLY VIEWED PRODUCTS</h6>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/CLF1601CRMMB-SWAMP-1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/DCF0707ISORB-JNS_1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/DCF1288PIERB-BLUTE-1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
          </div>
          <div class="border-bottom mt-3"></div>
          <!-- Social Info -->
          <div class="mt-4">
            <h4 class="text-danger">Social Info</h4>
            <div>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-facebook text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-instagram text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-linkedin text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-twitter text-info fs-4 mx-2"></i>
              </a>
            </div>
          </div>
          
        </div>
  
    </div>
  </div>
  <!--=========== End sidebar tabs =========-->
      <div class="col-md-3 d-none d-lg-block">
          <!-- checks and FILTER BY CATEGORIES -->
          <div class="border-bottom"  style="max-height: 300px; overflow-y: auto;">
            <h6 class="text-danger fw-bold">FILTER BY CATEGORIES</h6>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                Arca
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                Peninsula
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                Quadratura
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                Western
              </label>
            </div>
          
            </div>
          <!-- checks and FILTER BY SIZE -->
          <div class="border-bottom mt-4"  style="max-height: 300px; overflow-y: auto;">
            <h6 class="text-danger fw-bold">FILTER BY SIZE</h6>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
              6.0 UK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                7.0 UK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                8.0 UK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                8.5 UK
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-secondary fs-7 mb-2" for="flexCheckDefault">
                9.0 UK
              </label>
            </div>
            </div>
            <div class="mt-4">
              <h6 class="text-danger fw-bold">FILTER BY COLOR</h6>
              <div class=" row">
                <div class="col-10 d-flex flex-wrap">
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:rebeccapurple;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:gray;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:yellow;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:black;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:#41492b;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">  <span class="color-inp col-sm-2 mb-2" style="background-color:navy;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue"><span class="color-inp col-sm-2 mb-2" style="background-color:#41492b;"></span></div>
                  <div data-toggle="tooltip" title="" class="woocommerce_attribute_item-title col-sm-3" data-original-title="Blue">  <span class="color-inp col-sm-2 mb-2" style="background-color:navy;"></span></div>
                </div>
                </div>
            </div>
          <div class="border-bottom mt-3"></div>
          <!-- RECENTLY VIEWED PRODUCTS -->
          <div class="mt-4">
            <h6 class="text-danger fw-bold">RECENTLY VIEWED PRODUCTS</h6>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/CLF1601CRMMB-SWAMP-1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/DCF0707ISORB-JNS_1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
            <a class="d-flex align-items-center text-decoration-none mb-3" href="">
              <div>
                <img src="images/DCF1288PIERB-BLUTE-1.webp" alt="" width="70">
              </div>
              <div class="mx-3">
              <p class="m-0 fs-7 text-black">Fissare Ostrich</p>
              <p class="m-0 fs-7 fw-semibold text-info">د.إ 3,650.00</p>
              </div>
            </a>
          </div>
          <div class="border-bottom mt-3"></div>
          <!-- Social Info -->
          <div class="mt-4">
            <h4 class="text-danger">Social Info</h4>
            <div>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-facebook text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-instagram text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-linkedin text-info fs-4 mx-2"></i>
              </a>
              <a href="" class="text-decoration-none" target="_blank">
                <i class="fa-brands fa-twitter text-info fs-4 mx-2"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <!-- start header  -->
          <div class="d-flex justify-content-between">
            <p class="mt-2 text-secondary"> all results </p>
            <div class="d-flex">
              <div class="mx-2 mt-2 d-none d-lg-flex">
                <span class="fw-semibold text-secondary fs-7 mx-1">Show </span>
                <span class="text-secondary fs-7 mx-1">9 </span>
                <span class="text-secondary fs-7 mx-1">/ </span>
                <span class="text-secondary fs-7 mx-1">12 </span>
                <span class="text-secondary fs-7 mx-1">/ </span>
                <span class="text-secondary fs-7 mx-1">15 </span>
              </div>
              <div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link  d-none d-md-block" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa-solid fa-border-all"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa-solid fa-table-cells"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link  d-none d-md-block" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa-solid fa-grip"></i></button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false"><i class="fa-solid fa-bars"></i></button>
                  </li>
                </ul>
              </div>
              <div>
                <select class="form-select" aria-label="Default select example">
                  <option selected>Default Sorting</option>
                  <option value="1">Sort By popularity</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
            </div>
          </div>
          <!-- end header  -->
        
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
      <!-- start cards  -->
          <div class="row py-4">
            <div class="col-md-6 col-lg-6 col-6">
                <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card position-relative text-decoration-none">
                    <div class="card-body d-flex flex-column">
                        <div class="box rounded-3">
                            <div class="d-flex rounded-3 img-wrapper">
                                <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="text-danger"> The dragon hotels</h6>
                            <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        </div>
                        <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                        <div>
                          <div class="row">
                            <div class="col-sm-2 col-3">
                              <div class="m-0 p-0">
                                <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                              </div>
                            </div>
                            <div class="col-sm-2 col-3">
                              <div class="m-0 p-0">
                                <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                              </div>
                            </div>
                            <div class="col-sm-2 col-3">
                              <div class="m-0 p-0">
                                <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                              </div>
                            </div>
                            <div class="col-sm-2 col-3">
                              <div class="m-0 p-0">
                                <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-6 col-6">
                <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card position-relative text-decoration-none">
                    <div class="card-body d-flex flex-column">
                        <div class="box rounded-3">
                            <div class="d-flex rounded-3 img-wrapper">
                                <img src="images/DCF1288PIERB-BLUTE-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="text-danger"> The dragon hotels</h6>
                            <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        </div>
                        <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-6 col-6">
                <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card position-relative text-decoration-none">
                    <div class="card-body d-flex flex-column">
                        <div class="box rounded-3">
                            <div class="d-flex rounded-3 img-wrapper">
                                <img src="images/DCLF2177NO-OWH_1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="text-danger"> The dragon hotels</h6>
                            <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        </div>
                        <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    </div>
                </a>
            </div>
          </div>
          </div>
          <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <!-- start cards  -->
          <div class="row py-4">
            <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card col-md-4 col-lg-4 col-6 position-relative text-decoration-none">
                <div class="card-body d-flex flex-column">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper">
                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                    </div>
                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    <div class="row">
                      <div class="col-sm-2 col-3 mb-2">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 col-3 mb-2">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 col-3 mb-2">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 col-3 mb-2">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                    
                    </div>
                    
                </div>
              </a>
            <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card col-md-4 col-lg-4 col-6 position-relative text-decoration-none">
                <div class="card-body d-flex flex-column">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper">
                            <img src="images/DCF0707ISORB-JNS_1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                    </div>
                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    <div class="row">
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                    
                    </div>
                </div>
              </a>
            <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card col-md-4 col-lg-4 col-6 position-relative text-decoration-none">
                <div class="card-body d-flex flex-column">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper">
                            <img src="images/DCF1288PIERB-BLUTE-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                    </div>
                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    <div class="row">
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      
                    
                    </div>
                </div>
              </a>
            <a href="product-details.blade.php" class="card rounded-4 border-0 p-1 profile-card col-md-4 col-lg-4 col-6 position-relative text-decoration-none">
                <div class="card-body d-flex flex-column">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper">
                            <img src="images/DCLF2177NO-OWH_1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                    </div>
                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                    <div class="row">
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                      <div class="col-sm-2 mb-2 col-3">
                        <div class="m-0 p-0">
                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                        </div>
                      </div>
                    
                    </div>
                </div>
              </a>
            
          </div>
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
                  <!-- start cards  -->
                  <div class="row py-4">
                    <div class="col-md-4 col-lg-3 col-6">
                        <a href="product-details.blade.php" class="text-decoration-none">
                            <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                                <div class="card-body d-flex flex-column">
                                    <div class="box rounded-3">
                                        <div class="d-flex rounded-3 img-wrapper">
                                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-danger"> The dragon hotels</h6>
                                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                                    </div>
                                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                                    <div class="row">
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-3 col-6">
                        <a href="product-details.blade.php" class="text-decoration-none">
                            <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                                <div class="card-body d-flex flex-column">
                                    <div class="box rounded-3">
                                        <div class="d-flex rounded-3 img-wrapper">
                                            <img src="images/DCF1288PIERB-BLUTE-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-danger"> The dragon hotels</h6>
                                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                                    </div>
                                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                                    <div class="row">
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-3 col-6">
                        <a href="product-details.blade.php" class="text-decoration-none">
                            <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                                <div class="card-body d-flex flex-column">
                                    <div class="box rounded-3">
                                        <div class="d-flex rounded-3 img-wrapper">
                                            <img src="images/DCLF2177NO-OWH_1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-danger"> The dragon hotels</h6>
                                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                                    </div>
                                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                                    <div class="row">
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-3 col-6">
                        <a href="product-details.blade.php" class="text-decoration-none">
                            <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                                <div class="card-body d-flex flex-column">
                                    <div class="box rounded-3">
                                        <div class="d-flex rounded-3 img-wrapper">
                                            <img src="images/DCF0707ISORB-JNS_1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-danger"> The dragon hotels</h6>
                                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                                    </div>
                                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                                    <div class="row">
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="30" alt="">
                                        </div>
                                      </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-3 col-6">
                        <a href="product-details.blade.php" class="text-decoration-none">
                            <div class="card rounded-4 border-0 p-1 profile-card position-relative">
                                <div class="card-body d-flex flex-column">
                                    <div class="box rounded-3">
                                        <div class="d-flex rounded-3 img-wrapper">
                                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="text-danger"> The dragon hotels</h6>
                                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                                    </div>
                                    <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                                    <div class="row">
                                      <div class="col-sm-3 mb-2 col-3">
                                        <div class="m-0 p-0">
                                          <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="30" alt="">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
          </div>
          <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
                  <!-- start cards  -->
          <div class="row py-4">
            <a href="product-details.blade.php" class="text-decoration-none">
              <div class="card rounded-4 border-0 p-1 profile-card col-md-12 col-lg-12 col-12 position-relative">
                <div class="card-body d-flex flex-row align-items-center position-relative">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper position-relative">
                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        <div class="row">
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            </a>
          <div class="border-bottom mt-3"></div>
            <a href="product-details.blade.php" class="text-decoration-none">
              <div class="card rounded-4 border-0 p-1 profile-card col-md-12 col-lg-12 col-12 position-relative">
                <div class="card-body d-flex flex-row align-items-center position-relative">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper position-relative">
                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        <div class="row">
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            </a>
          <div class="border-bottom mt-3"></div>
            <a href="product-details.blade.php" class="text-decoration-none">
              <div class="card rounded-4 border-0 p-1 profile-card col-md-12 col-lg-12 col-12 position-relative">
                <div class="card-body d-flex flex-row align-items-center position-relative">
                    <div class="box rounded-3">
                        <div class="d-flex rounded-3 img-wrapper position-relative">
                            <img src="images/NBK1524CCUNO-SAL-1.webp" class="home-cards-img rounded-3 mx-auto object-fit-cover w-100 h-100" alt="...">
                            <i class="fa-regular fa-heart text-success fs-6 link-primary cursor-pointer mt-1 position-absolute top-0 end-custom heartIcon" style="right: 0;"></i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="text-danger"> The dragon hotels</h6>
                        <h6 class="text-danger fw-semibold">د.إ 3,850.00</h6>
                        <div class="row">
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img imageTooltip" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                          <div class="col-sm-2 mb-2 col-3">
                            <div class="m-0 p-0">
                              <img src="images/DCF1288PIERB-BLUTE-1.webp" class="border rounded-1 border-img tooltip-img" width="40" alt="">
                            </div>
                          </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            </a>
          <div class="border-bottom mt-3"></div>
          
          </div>
          </div>
        </a>
          <!-- end cards  -->
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
    <script>
      $(document).ready(function(){
        $(".color-inp").click(function(){
          $(this).toggleClass("selected");
        });
      });
    </script>
      
  </body>
</html>

