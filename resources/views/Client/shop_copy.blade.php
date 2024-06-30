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

  <section class="pb-5 border-bottom">
    <div class="container-fluid">
      <div class="row p-0 m-0 border mx-3">
        <div class="d-flex align-items-start m-0 p-0 flex-lg-row flex-column">
          <div class="col-lg-9 col-12 order-sm-1 order-lg-2">
            <div class="parent-container" style="position: relative;">
              <div class="col-left leftsidebar slide-left left-skip wpml_search_right" style="position: absolute; top: 0; right: 0;">
                {{--
               <div class="map-search-window" id="wpm-search-bar">

                 <div class="search-options-btn">
                   <a class="wpml-toggle-box" id="Toggle-Search">
                     <i class="fa-solid fa-bars"></i>
                   </a>
                   Search Options
                 </div>
                 <div class="store-search-fields show_store_locator" style="display: none;" id="show-store-searc">
                   <form id="store_locator_search_form">
                     <div class="store_locator_field">
                       <input id="store_locatore_get_btn" class="btn btn-black rounded-0 col-12 mt-2" type="button" value="Get My Location">
                     </div>
                     <div class="store_locator_field">
                       <input id="store_locatore_search_input" class="wpsl_search_input pac-target-input form-control mt-2" name="store_locatore_search_input" type="text" placeholder="Location / Zip Code" autocomplete="off">
                     </div>
                     <div class="store_locator_field mt-2">
                       <select id="store_locatore_search_radius" name="store_locatore_search_radius" class="wpsl_search_radius form-select">
                         <option value="5">5 km</option>
                         <option value="10">10 km</option>
                         <option value="25" selected="">25 km</option>
                         <option value="200">200 km</option>
                         <option value="500">500 km</option>
                       </select>
                     </div>
                     <div class="store_locator_field hide-field">
                       <select name="store_locator_category" id="wpsl_store_locator_category" class="wpsl_locator_category form-select mt-2">
                         <option value="">Select Category </option>
                         <option value="658"> Sandal </option>
                       </select>
                     </div>
                     <div class="store_locator_field">
                       <select  class="wpsl_locator_category select2-hidden-accessible form-select">
                         <option value="" disabled="" selected="">
                           Select Tags
                         </option>
                       </select>
                       <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr">
                         <span class="dropdown-wrapper" aria-hidden="true"></span>
                       </span>
                     </div>
                     <div class="mt-2">
                       <input type="search" class="form-control" placeholder="search here .." required="" name="" id="">
                     </div>
                     <div class="store_locator_field">
                       <div class="map-btns">
                         <span>
                           <input id="store_locatore_search_btn" class="btn btn-black rounded-0 fs-7 mt-3 mb-2" type="submit" value="Search">
                         </span>
                       </div>
                     </div>
                   </form>
                 </div>

                </div>
              </div>
               --}}
                <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7220.1505127454175!2d55.269680487922365!3d25.200684468560077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69f9f8b3637f%3A0x42a8539675afcea4!2sPrivate%20Collection%20-%20The%20Dubai%20Mall!5e0!3m2!1sen!2seg!4v1708615682877!5m2!1sen!2seg" class="w-100 vh-100 posi" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7220.1505127454175!2d55.269680487922365!3d25.200684468560077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69f9f8b3637f%3A0x42a8539675afcea4!2sPrivate%20Collection%20-%20The%20Dubai%20Mall!5e0!3m2!1sen!2seg!4v1708615682877!5m2!1sen!2seg" class="w-100 vh-100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 order-sm-2 order-lg-1">
            <div class="bg-primary w-100">
              <h5 class="text-white text-center py-2">@lang('trans.locations')</h5>
            </div>
            <div class="nav flex-column nav-pills m-0 p-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              @foreach($stores as $store)
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                  <div class="d-flex">
                    <div>
                      <div class="circle-count">{{$loop->index}}</div>
                    </div>
                    <div class="mx-2 d-flex flex-column">
                      <h6 class="wpsl-name text-secondary fs-7 fw-semibold mt-1"> - The Dubai Mall</h6>
                      <div class="d-flex justify-content-between ">
                        <div class="d-flex flex-column  justify-content-start align-items-start">
                          <div>
                            <a href="" class="btn btn-black rounded-1 py-1 px-4 fs-7">1.39 km</a>
                          </div>
                          <p id="locationText" class="text-secondary locationText fs-7 mt-1 m-0 p-0">Level Shoes, Ground Floor - The Dubai Mall</p>
                          <p class="text-secondary fs-7 m-0 p-0"> Dubai</p>
                          <div class="d-flex align-items-center m-0 p-0">
                            <a href="" class="d-flex justify-content-between fs-7 flex-row text-decoration-none">
                              04 501 6960
                            </a>
                            <div class="social-links mx-2">
                              <a href="" class="d-flex align-items-center justify-content-center rounded-5 fs-5" target="_blank"><i class="bi bi-whatsapp"></i></a>
                            </div>
                          </div>
                          <div class="d-flex">
                            <a href="http://privatecollection.ae" target="_blank" class="text-decoration-none fs-small">Visit Website</a>
                            <a href="https://www.google.com/maps?daddr=25.1963744,55.278995" target="_blank" class="text-decoration-none fs-small mx-1">Get Direction</a>
                          </div>
                        </div>
                        <div>
                          <img src="images/tdm.webp" width="70" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </button>
                <div class="border-bottom"></div>
              @endforeach
              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <div>
                  <div class="d-flex mx-2 mt-2">
                    <div>
                      <div class="circle-count">2</div>
                    </div>
                    <div class="mx-2">
                      <input type="hidden" id="pano-address-91321" class="pano-address" value="Level Shoes, Ground Floor - The Dubai Mall">
                      <div class="d-flex flex-column justify-content-start">
                        <h6 class="wpsl-name text-secondary fs-7 fw-semibold mt-1">2
                          Private Collection - Wafi mall</h6>
                        <div class="d-flex justify-content-between">
                          <div class="d-flex flex-column justify-content-start align-items-start">
                            <div class="">
                              <a href="" class="btn btn-black rounded-1 py-1 px-4 fs-7">6.30 km</a>
                            </div>
                            <p class="text-secondary locationText fs-7 m-0 p-0 mt-1">
                              Wafi Mall - Shop 246، Atrium 1st Floor - Dubai
                            </p>

                            <p class="text-secondary fs-7 m-0 p-0"> Dubai</p>
                            <div class="d-flex align-items-center m-0 p-0">
                              <a href="" class="d-flex justify-content-between fs-7 flex-row text-decoration-none">
                                04 501 6960
                              </a>
                              <div class="social-links mx-2">
                                <a href="" class="d-flex align-items-center justify-content-center rounded-5 fs-5" target="_blank"><i class="bi bi-whatsapp"></i></a>
                              </div>
                            </div>
                            <div class="d-flex">
                              <a href="http://privatecollection.ae" target="_blank" class="text-decoration-none fs-small">Visit Website</a>
                              <a href="https://www.google.com/maps?daddr=25.1963744,55.278995" target="_blank" class="text-decoration-none fs-small mx-1">Get Direction</a>
                            </div>
                          </div>
                          <div>
                            <img src="images/WhatsApp-Image-2023-05-12-at-2.17.14-PM.webp" width="70" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </button>
            </div>
          </div>


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

