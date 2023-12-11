<x-front-layout title="{{ config('app.name') }}">

    <!-- Start Slider Area -->
    <section class="hero-area">
        <div class="container">

            <x-frontend.alert type="info" />
            
            <div class="row">

                
                <div class="col-lg-12 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            @foreach ($main_categories as $main_category)
                            <div class="single-slider">
                                <h5 class="category-name">{{ $main_category->name}}</h5>
                                <div class="content">
                                    

                                    @foreach ($sup_categories as $sup_category)
                                    @if ($sup_category->parent_id == $main_category->id)
                                    <a href="{{ Route('shop_grid.index', $sup_category->id) }}">
                                        <div class="caty"><img src="{{ $sup_category->image_url }}" style="border-radius=50%"></div>
                                    </a>
                                    @endif
                                    @endforeach

                                </div>
 
                            </div>
                            @endforeach
                            <!-- End Single Slider -->

                     
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
              

            </div>
        </div>
    </section>
    <!-- End Slider Area -->
 
     

    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Product</h2>
                        {{-- <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <x-frontend.product-card :product="$product" />
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->
  


 

 
    <!-- Start Brands Area -->
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-12 col-12">
                    <h2 class="title">Popular Brands</h2>
                </div>
            </div>
            <div class="brands-logo-wrapper">

                <div class="brands-logo-carousel d-flex align-items-center justify-content-between">
                    @foreach ($stores as $store)                 
                    <div class="brand-logo">
                        <a href="{{ route('shop_grid.indexStore', ['storeId' => $store->id]) }}">
                           
                        
                        <img src="{{$store->cover_image_url}}" alt="#">
                        <br>
                        {{ $store->name }}
                    </a>
                    </div>
 
                @endforeach
 
                </div>
            </div>
        </div>
    </div>
    <!-- End Brands Area -->
 
 

   
    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->

   

    @push('scripts')
        <script type="text/javascript">
            //========= Hero Slider 
            tns({
                container: '.hero-slider',
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 30,
                items: 1,
                nav: false,
                controls: true,
                controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
            });

            //======== Brand Slider
            tns({
                container: '.brands-logo-carousel',
                autoplay: true,
                autoplayButtonOutput: false,
                mouseDrag: true,
                gutter: 0,
                nav: false,
                controls: true,
				 
				responsive: {
                    0: {
                        items: 1,
                    },
                    540: {
                        items: 3,
                    },
                    768: {
                        items: 5,
                    },
                    992: {
                        items: 6,
                    }
                }
            });
        </script>
         
        <script>
            const csrf_token = "{{ csrf_token() }}";
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
    @endpush

</x-front-layout>