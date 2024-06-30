function MainNavigation() {
  document.write(`
  <div class="fixed-top bg-primary">
  <!-- Start Navbar  -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
      <span class="navbar-toggler-icon"> </span>
    </button>
      <div class="d-block d-lg-none">
        <a class="navbar-brand" href="index.html"><img src="images/22.png" alt=""></a>
      </div>
      <div class="d-block d-lg-none">
      <a href="favourite.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset position-relative">
        <i class="fa-regular fa-heart fs-5 mx-1">
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
        <a href="cart.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset position-relative">
        <i class="bi bi-bag fs-5 mx-1"></i>
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
      </div>
      <div class="collapse navbar-collapse">
        <div class="input-box me-auto">
          <span class="search" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa fa-search search-icon text-white fs-5"></i>
          </span>
        </div>
        <div class="mx-auto d-flex">
          <a class="navbar-brand" href="index.html"><img src="images/22.png" alt=""></a>
        </div>
        <ul class="navbar-nav ms-5 mb-2 mb-lg-0 align-items-center d-flex">
        <div class="dropdown">
  <button class=" dropdown-toggle bg-transparent border-0 text-white mx-2 d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <div>
  <img src="images/1f1e6-1f1ea.svg" alt="" width="20" class="mx-2" />
  </div>
    UAE
  </button>
  <ul class="dropdown-menu rounded-0 border-0 small-dropdown">
    <li><a class="dropdown-item d-flex" href="#"> 
     <div>
    <img src="images/1f1f6-1f1e6.svg" alt="" width="15" class="mx-2" />
    </div>
    QATAR</a>
      </li>
    <li><a class="dropdown-item d-flex" href="#"> 
     <div>
    <img src="images/1f1f4-1f1f2.svg" alt="" width="15" class="mx-2" />
    </div>
    OMAN</a>
      </li>
    <li><a class="dropdown-item d-flex" href="#"> 
     <div>
    <img src="images/1f1f8-1f1e6.svg" alt="" width="15" class="mx-2" />
    </div>
    KSA</a>
      </li>
    
  </ul>
</div>
        <div>
        <a href="login.html" class="header__icon text-decoration-none text-white header__icon--account link focus-inset small-hide">
        <i class="fa-regular fa-user fs-5 mx-1"></i>
        </a>
    
        <a href="favourite.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
        <i class="fa-regular fa-heart fs-5 mx-1">
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
        <a href="cart.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
        <i class="bi bi-bag fs-5 mx-1"></i>
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>

      </div>
      
        </ul>
      
        
      </div>
    </div>
  </nav>
  <div class="py-2 d-none d-lg-block">
    <div class="container justify-content-center d-flex align-items-center flex-wrap none">
      <a href="new-collection.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">NEW COLLECTION</a>
      <div class="dropdown">
      <button class=" dropdown-toggle text-white bg-transparent border-0 dropdown-toggle fw-semibold fs-7" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        CLASSIC
      </button>
      <ul class="dropdown-menu mega-sub-menu border-0 rounded-0 shadow">
        <div class="row">
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
        </div>
      </ul>
    </div>      
      <a href="" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">KIDS</a>
      <div class="dropdown">
        <button class="text-white bg-transparent border-0 dropdown-toggle fw-semibold fs-7" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        SUNGLASSES
      </button>
      <ul class="dropdown-menu small-dropdown border-0 shadow rounded-0">
      <li><a class="dropdown-item" href="new-collection.html">L.G.R.</a></li>
      <li><a class="dropdown-item" href="new-collection.html">Movitra </a></li>
    </ul>
    </div>
      <a href="shop.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">ACCESSORIES </a>
      <a href="our-store.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">OUR STORES </a>
    </div>
  </div>
  <!-- End Navbar  -->
</div>
<!-- Start Modal  -->
<!-- Modal -->
<div class="modal fade rounded-0 border-0 mt-8" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl rounded-0 border-0">
    <div class="modal-content rounded-0 border-0">
      <div class="modal-header border-0 py-4">
        <h1 class="modal-title fs-5" id="SearchModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-5 rounded-0 border-0">
        <div class="row d-flex flex-column justify-content-center align-items-center">
        <div class="col-sm-10">
        <form class="d-flex border-0 shadow">
          <input type="text" class="form-control rounded-0 border-0" placeholder="Search">
           <a href="shop.html" class="btn btn-white rounded-0"> <span class="fa fa-search form-control-feedback text-info"></span></a>
        </form>
      </div>
            <div class="mt-5 col-sm-10 text-center">
              <h5 class="text-danger fw-semibold">Enter Search Keyword...</h5>
            </div>
            <div class="mt-4 mb-3 col-sm-10 d-flex justify-content-center flex-wrap">
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Arce</a>
                  </div>
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Cinghia</a>
                  </div>
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Orientale</a>
                  </div>
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Peninsula</a>
                  </div>
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Quadratura</a>
                  </div>
                  <div class="mx-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Western</a>
                  </div>
                  <div class="col-sm-2">
                      <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">SUNGLASSES</a>
                  </div>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0">
      </div>
    </div>
  </div>
</div>
<!-- End Modal  -->
  `);
}
function MainNavigationtwo() {
  document.write(`
  <div class="fixed-top scroll-nav bg-primary">
  <!-- Start Navbar  -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
      <span class="navbar-toggler-icon"> </span>
    </button>
      <div class="d-block d-lg-none">
        <a class="navbar-brand" href="index.html"><img src="images/22.png" alt=""></a>
      </div>
      <div class="d-block d-lg-none">
      <a href="favourite.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset position-relative">
        <i class="fa-regular fa-heart fs-5 mx-1">
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
        <a href="cart.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset position-relative">
        <i class="bi bi-bag fs-5 mx-1"></i>
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="input-box me-auto">
          <span class="search" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa fa-search search-icon text-white fs-5"></i>
          </span>
        </div>
        <div class="mx-auto d-flex">
          <a class="navbar-brand" href="index.html"><img src="images/22.png" alt=""></a>
        </div>
        <ul class="navbar-nav ms-5 mb-2 mb-lg-0 align-items-center d-flex">
        <div class="dropdown border-0 rounded-0">
  <button class=" dropdown-toggle bg-transparent border-0 text-white mx-2 d-flex align-items-center rounded-0 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <div>
  <img src="images/1f1e6-1f1ea.svg" alt="" width="20" class="mx-2" />
  </div>
    UAE
  </button>
  <ul class="dropdown-menu small-dropdown rounded-0 border-0">
    <li><a class="dropdown-item d-flex rounded-0 border-0" href="#"> 
     <div>
    <img src="images/1f1f6-1f1e6.svg" alt="" width="15" class="mx-2" />
    </div>
    QATAR</a>
      </li>
    <li><a class="dropdown-item d-flex rounded-0 border-0" href="#"> 
     <div>
    <img src="images/1f1f4-1f1f2.svg" alt="" width="15" class="mx-2" />
    </div>
    OMAN</a>
      </li>
    <li><a class="dropdown-item d-flex rounded-0 border-0" href="#"> 
     <div>
    <img src="images/1f1f8-1f1e6.svg" alt="" width="15" class="mx-2" />
    </div>
    KSA</a>
      </li>
    
  </ul>
  </div>
        <div>
        <a href="login.html" class="header__icon text-decoration-none text-white header__icon--account link focus-inset small-hide">
        <i class="fa-regular fa-user fs-5 mx-1"></i>
        </a>
      
        <a href="favourite.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
        <i class="fa-regular fa-heart fs-5 mx-1">
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
        <a href="cart.html" class="header__icon text-decoration-none mx-2 text-white header__icon--account link focus-inset small-hide position-relative">
        <i class="bi bi-bag fs-5 mx-1"></i>
        <span class="icon-number position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 8px;">1</span>
        </i>
        </a>
  
      </div>
      
        </ul>
      
        
      </div>
    </div>
  </nav>
  <div class="py-2 d-none d-lg-block">
    <div id="containerToShowOnScroll" class="container justify-content-center d-flex align-items-center flex-wrap d-none">
      <a href="new-collection.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">NEW COLLECTION</a>
      <div class="dropdown">
      <button class=" dropdown-toggle text-white bg-transparent border-0 dropdown-toggle fw-semibold fs-7" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        CLASSIC
      </button>
      <ul class="dropdown-menu mega-sub-menu border-0 rounded-0 shadow">
        <div class="row">
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
          <div class="col-sm-3">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>

          </div>
        </div>
      </ul>
    </div>      
      <a href="" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">KIDS</a>
      <div class="dropdown">
        <button class="text-white bg-transparent border-0 dropdown-toggle fw-semibold fs-7" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        SUNGLASSES
      </button>
      <ul class="dropdown-menu small-dropdown border-0 shadow rounded-0">
      <li><a class="dropdown-item" href="new-collection.html">L.G.R.</a></li>
      <li><a class="dropdown-item" href="new-collection.html">Movitra </a></li>
    </ul>
    </div>
      <a href="shop.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">ACCESSORIES </a>
      <a href="our-store.html" class="text-white text-decoration-none fw-semibold nav-link nav-hover mx-3 fs-7 ">OUR STORES </a>
    </div>
  </div>
  <!-- End Navbar  -->
  </div>
  <!-- Start Modal  -->
  <!-- Modal -->
  <div class="modal fade rounded-0 border-0 mt-8" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl rounded-0 border-0">
      <div class="modal-content rounded-0 border-0">
        <div class="modal-header border-0 py-4">
          <h1 class="modal-title fs-5" id="SearchModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-5 rounded-0 border-0">
          <div class="row d-flex flex-column justify-content-center align-items-center">
          <div class="col-sm-10">
          <form class="d-flex border-0 shadow">
            <input type="text" class="form-control rounded-0 border-0" placeholder="Search">
             <a href="shop.html" class="btn btn-white rounded-0"> <span class="fa fa-search form-control-feedback text-info"></span></a>
          </form>
        </div>
              <div class="mt-5 col-sm-10 text-center">
                <h5 class="text-danger fw-semibold">Enter Search Keyword...</h5>
              </div>
              <div class="mt-4 mb-3 col-sm-10 d-flex justify-content-center flex-wrap">
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Arce</a>
                    </div>
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Cinghia</a>
                    </div>
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Orientale</a>
                    </div>
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Peninsula</a>
                    </div>
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Quadratura</a>
                    </div>
                    <div class="mx-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">Western</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="shop.html" class="btn btn-outline-warning text-decoration-none btn-max rounded-1 py-1 mb-3">SUNGLASSES</a>
                    </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0">
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal  -->
  `);
}

function MainFooter() {
  document.write(`
  <footer class="py-5">
  <div class="container">
    <div class="row"> 
      <!-- start one  -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <!-- Logo  -->
        <div class="logo">
          <a href="index.html"><img src="images/WhatsApp Image 2024-02-25 at 11.png" alt="Logo"></a>
      </div>
      <div class="mt-4">
        <div class="d-flex mb-4">
          <div class="icon">
          <img src="images/location.png" />
          </div>
          <div class="conent mx-3">
            Dubai
          </div>
        </div>
        <div class="d-flex mb-4">
          <div class="icon">
          <img src="images/call.png" />
          </div>
          <div class="conent mx-3">
            +971 553439920

          </div>
        </div>
        <div class="d-flex mb-4">
          <div class="icon">
          <img src="images/Mail.png" />
          </div>
          <div class="conent mx-3">
            info@privatecollection.ae

          </div>
        </div>
      </div>
      </div>
    <!-- start two  -->
    <div class="col-lg-3 col-md-6 col-sm-6">
      <h6 class="text-danger fw-semibold mb-4">Top Category</h6>
      <div class="d-flex flex-column hover-links">
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Cinghia</a>
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Peninsula</a>
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Quadratura</a>
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Arca</a>
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Western</a>
        <a href="shop.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Arabian</a>

      </div>
    
    </div>
      <!-- start three  -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <h6 class="text-danger fw-semibold mb-4">Useful Links </h6>
        <div class="d-flex flex-column hover-links">
          <a href="wishlist.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Wishlist</a>
          <a href="my-account.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> My Account</a>
          <a href="checkout.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Checkout</a>
          <a href="cart.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Cart</a>
          <a href="our-store.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Our Stores</a>
        </div>
      </div>
        <!-- start four  -->
        <div class="col-lg-3 col-md-6 col-sm-6">
          <h6 class="text-danger fw-semibold mb-4">Information</h6>
          <div class="d-flex flex-column hover-links">
            <a href="faqs.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> FAQs</a>
            <a href="terms-conditions.html" class="text-decoration-none text-danger fs-7 mb-2 link-info"><i class="fa fa-angle-right fs-7 mx-1"></i> Terms & Conditions</a>
          

          </div>
        </div>

    </div>

    </div>
    </footer>
    <div class="py-3 bg-light">
    <div class="container">
    <span class="text-danger">© Copyright 2024 <a href="" class="text-decoration-none text-danger link-info">Private Collection</a> All Rights Reserved.  </span>
    </div>
    </div>
  `);
}

function includeSidebar() {
  document.write(`
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanvas-header bg-white">
      <h5 class="offcanvas-title text-primary" id="offcanvasWithBothOptionsLabel"><img src="images/WhatsApp Image 2024-02-25 at 11.png" alt=""> </h5>
      <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body bg-white">
      <div class="input-group border">
        <input type="text" class="form-control border-0" placeholder="Search this blog">
        <div class="input-group-append">
          <button class="btn btn-secondary rounded-0 bg-transparent text-info border-0" type="button">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
      <ul class="navbar-nav  hover-links">
        <li class="nav-item py-1 border-bottom ">
            <a class="nav-link text-black active fw-semibold mx-3 text-capitalize" href="new-collection.html">NEW COLLECTION</a>
        </li>
        <div class="accordion border-0" id="accordionExample">
          <div class="accordion-item border-bottom border-0">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                CLASSIC
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
              <ul>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">View All</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Arabian.</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Arca</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Cinghia</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Peninsula</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Quadratura</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Western</a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">KIDS</a></li>
              </ul>
              </div>
            </div>
          </div>
          <li class="nav-item py-1 border-bottom ">
            <a class="nav-link text-black active fw-semibold mx-3 text-capitalize" href="shop.html"> KIDS</a>
        </li>
        <div class="accordion-item border-bottom border-0">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              SUNGLASSES
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              <ul>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">L.G.R.
                  </a></li>
                <li class="list-unstyled"><a class="text-capitalize nav-link fw-semibold" href="shop.html">Movitra</a></li>
              </ul>
            </div>
          </div>
        </div>
          <li class="nav-item py-1 border-bottom ">
            <a class="nav-link text-black active fw-semibold mx-3 text-capitalize" href="#"> ACCESSORIES</a>
        </li>
          <li class="nav-item py-1 border-bottom ">
            <a class="nav-link text-black active fw-semibold mx-3 text-capitalize" href="our-store.html"> OUR STORES</a>
        </li>
          <li class="nav-item py-1 border-bottom ">
            <a class="nav-link text-black active fw-semibold mx-3 text-capitalize" href="my-account.html"> MY ACCOUNT</a>
        </li>
          <div class="accordion-item border-bottom border-0">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                CAN WE HELP YOU ?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <ul>
                  <li class="list-unstyled"><a class="text-capitalize nav-link text-black fw-semibold" href="#">+971 45648397
                    </a></li>
                  <li class="list-unstyled"><a class="text-capitalize nav-link text-black fw-semibold" href="#"> +971 553439920</a></li>
                </ul>
              </div>
            </div>
          </div>
        
        </div>
      </ul>
    </div>
  </div>
  `);
}



