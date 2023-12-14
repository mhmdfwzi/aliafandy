<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $title }}" />
    <meta name="keyword" content="{{ $title }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/images/favicon.png') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" /> 
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.6.3/css/ionicons.min.css">
        

 
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/rtl.css') }}" />
   
    @push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .ui-autocomplete {
            z-index: 1100;
            /* Adjust this value as needed to be higher than the modal */
            margin-right: 200px;
            width: 30%;


        }

        /* Style for the autocomplete container */
        .product-suggestion {
            display: flex;
            /* Use flexbox to arrange image and name in a row */
            flex-direction: row;
            /* Ensure a horizontal layout */
            align-items: center;
            /* Vertically center items within the suggestion container */
            padding: 5px;
            /* Add padding for spacing */
            border-bottom: 1px solid #ccc;
            /* Add a border between suggestions */
        }

        /* Style for the product image */
        .product-image {
            /* width: 50px; */
            /* Adjust the width as needed */
            /* height: 50px; */
            /* Adjust the height as needed */
            margin-right: 10px;
            /* Add margin for spacing between image and name */
        }

        /* Style for the product name */
        .product-name {
            font-weight: bold;
            /* Make the name text bold */
        }
    </style>
 


    @stack('styles')
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FYZ6QV4TMV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FYZ6QV4TMV');
</script>

</head>

<body>
 
    <!-- Preloader -->
    <div class="modal fade review-modal" id="SearchModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group input-group">
                                 
                        <input class="form-control" type="text"  id="search"
                          placeholder=" انتا بتدور على ايه؟  "    autofocus style="direction: ltr; text-align:right">
                    </div>
                     
                   
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

 
            </div>
        </div>
    </div>

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header">
        <div class="container">
            <div class="wrapper">
                <div class="header-item-left">
                    <a class="navbar-brand" href="{{ Route('home') }}">
                        <img src="{{ asset('frontend/assets/images/logo/logo.png') }}" alt="Logo">
                    </a>
                </div>
                <!-- Section: Navbar Menu -->
                <div class="header-item-center">
                    <div class="overlay"></div>
                    <nav class="menu">
                        <div class="menu-mobile-header">
                            <button type="button" class="menu-mobile-arrow"><i
                                    class="ion ion-ios-arrow-back"></i></button>
                            <div class="menu-mobile-title">aliafandy</div>
                            <button type="button" class="menu-mobile-close"><i class="ion ion-ios-close"></i></button>
                        </div>
                        <ul class="menu-section" style="direction: rtl">
							
                            <li class="menu-item-has-children">
                                <a href="#">حسابي <i class="ion ion-ios-arrow-down"></i></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        @auth('web')
                                            <li>
                                                <i class="lni lni-user"></i>
                                                <a href="{{ Route('profile.edit') }}">
                                                    {{ Auth::user('user')->first_name }} </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();document.getElementById('logout').submit()">
                                                    <i class="text-danger ti-unlock"></i>
                                                    Sign Out
                                                </a>
                                            </li>


                                            <form method="POST" action="{{ route('logout') }}" id="logout"
                                                style="display:none">
                                                @csrf
                                            </form>
                                        @else
                                            <li>
                                                <a href="{{ Route('login') }}"> <i class="mdi mdi-login"> </i>
                                                    {{ trans('front_home_trans.Sign_In') }}</a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ Route('register') }}">{{ trans('front_home_trans.Register') }}</a>
                                            </li>
                                        @endauth

 
                                        
                                        <li class="nav-item"><a href="{{ Route('jobs.create') }}"><i
                                                    class="ion ion-md-checkmark">
                                                </i>الوظائف</a></li>

                                    </ul>
                                </div>
                            </li>
							<li><a href="{{ Route('offers.index') }}">العروض</a></li>
          					<li class="nav-item"><a href="{{ Route('shop_grid.index') }}">
							  معرض المنتجات</a></li>



                            @foreach ($main_categories as $main_category)

                            
                            <li class="menu-item-has-children contacts">   
                                <a href="#">{{ $main_category->name }}  <i class="ion ion-ios-arrow-down"></i></a>
                                <div class="menu-subs menu-column-1">
                                    <ul>
                                        @php
                                        $sub_categories = App\Models\Category::where('parent_id', $main_category->id)->get();
                                        @endphp
                                                                        @foreach ($sub_categories as $sub_category)
                                                                                <li><a href="{{ Route('shop_grid.index', $sub_category->id) }}">{{ $sub_category->name }}</a></li>
                                                                             
                                                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                            


                        <li class="menu-item-has-children category_menu ">
                            <a href="#">التصنيفات <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-mega menu-column-4" style="direction: rtl">
                                @foreach ($main_categories as $main_category)
                                    <div class="list-item">
                                        <h4 class="title">{{ $main_category->name }}</h4>
                                        <ul>
                                            @php
            $sub_categories = App\Models\Category::where('parent_id', $main_category->id)->get();
            @endphp
                                            @foreach ($sub_categories as $sub_category)
                                                    <li><a href="{{ Route('shop_grid.index', $sub_category->id) }}">{{ $sub_category->name }}</a></li>
                                                 
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </li>

                        <li class="menu-item-has-children contacts  category_menu">
                            <a href="#">تواصل معنا <i class="ion ion-ios-arrow-down"></i></a>
                            <div class="menu-subs menu-column-1">
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/profile.php?id=100092454938621"><i
                                                class="lni lni-facebook-filled"></i></a>
                                        <a href="#"><i class="lni lni-youtube"></i></a>
                                        <a href="#"><i class="lni lni-instagram-filled"></i></a>

                                    </li>

                                    <li> <i class="mdi mdi-phone-in-talk"></i> 01555361715 </li>

                                </ul>
                            </div>
                        </li>

                        </ul>
                    </nav>
                    <div class="nav-social">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/profile.php?id=100092454938621"><i
                                        class="lni lni-facebook-filled"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-youtube"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-instagram-filled"></i></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><i class="lni lni-phone"></i></a>
                            </li>
                            <li> <i class="mdi mdi-phone-in-talk"></i> 01555361715 </li>



                        </ul>
                    </div>
                </div>

                

                <div class="navbar-cart">
                     <div class="wishlist" style="padding-right: 10px">
                    <button type="button" class="btn   " data-bs-toggle="modal"
                    data-bs-target="#SearchModal">
                    <i class="lni lni-search-alt"></i>
                </button></div>

                    <x-frontend.cart-menu> </x-frontend.cart-menu>
                </div>
                <div class="header-item-right">
                    <button type="button" class="menu-mobile-trigger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>

            </div>
        </div>
    </header>

    
    <!-- End Header Area -->

    <div style="height:75px;"></div>







    <!-- Start Breadcrumbs -->
    {{ $breadcrumbs ?? '' }}
    <!-- End Breadcrumbs -->



    {{ $slot }}


    <!-- Start Footer Area -->
   @include('frontend.layouts.footer')