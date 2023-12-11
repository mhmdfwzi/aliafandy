 <footer class="footer">

     <!-- End Footer Top -->


     <!-- Start Footer Middle -->
     <div class="footer-middle">
         <div class="container">
             <div class="bottom-inner">
                 <div class="row">
                     <div class="col-lg-3 col-md-6 col-12">
                         <!-- Single Widget -->
                         <div class="single-footer f-contact">
                             <h3>Get In Touch With Us</h3>
                             <p class="phone">Phone: 01555361715</p>
                             <p class="mail">
                                 <a href="mailto:support@aliafandy.com">support@aliafandy.com</a>
                             </p>
                         </div>
                         <!-- End Single Widget -->
                     </div>
                     <div class="col-lg-3 col-md-6 col-12">
                         <!-- Single Widget -->
                         <div class="single-footer our-app">
                             <h3>Our Mobile App</h3>
                             <ul class="app-btn">
                                 <li>
                                     <a
                                         href="https://play.google.com/store/apps/details?id=com.aliafandy&pcampaignid=web_share">
                                         <i class="lni lni-play-store"></i>
                                         <span class="small-title">Download on the</span>
                                         <span class="big-title">Google Play</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                         <!-- End Single Widget -->
                     </div>
                     <div class="col-lg-3 col-md-6 col-12">
                         <!-- Single Widget -->
                         <div class="single-footer f-link">
                             <h3>Information</h3>
                             <ul>
                                 <li><a href="javascript:void(0)">About Us</a></li>
                                 <li><a href="javascript:void(0)">Contact Us</a></li>
                                 <li><a href="javascript:void(0)">Downloads</a></li>
                                 <li><a href="javascript:void(0)">Sitemap</a></li>
                                 <li><a href="javascript:void(0)">FAQs Page</a></li>
                             </ul>
                         </div>
                         <!-- End Single Widget -->
                     </div>
                     <div class="col-lg-3 col-md-6 col-12">
                         <!-- Single Widget -->
                         <div class="single-footer f-link">
                             <h3>Shop Departments</h3>
                             <ul>
                                 <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                                 <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                                 <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                                 <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                                 <li><a href="javascript:void(0)">Headphones</a></li>
                             </ul>
                         </div>
                         <!-- End Single Widget -->
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End Footer Middle -->



     <!-- Start Footer Bottom -->
     <div class="footer-bottom">
         <div class="container">
             <div class="inner-content">
                 <div class="row align-items-center">
                     <div class="col-lg-4 col-12">
                         <div class="payment-gateway">
                             <span>We Accept:</span>
                             <img src="{{ asset('frontend/assets/images/footer/credit-cards-footer.png') }}"
                                 alt="#">
                         </div>
                     </div>
                     <div class="col-lg-4 col-12">
                         <div class="copyright">
                             <p>Designed and Developed by<a href="https://aliafandy.com/" rel="nofollow">Aliafandy</a>
                             </p>
                         </div>
                     </div>
                     <div class="col-lg-4 col-12">
                         <ul class="socila">
                             <li>
                                 <span>Follow Us On:</span>
                             </li>
                             <li><a href="https://www.facebook.com/profile.php?id=100092454938621"><i
                                         class="lni lni-facebook-filled"></i></a></li>
                             <li><a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a></li>
                             <li><a href="javascript:void(0)"><i class="lni lni-instagram"></i></a></li>
                             <li><a href="javascript:void(0)"><i class="lni lni-google"></i></a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End Footer Bottom -->
 </footer>
 <!--/ End Footer Area -->

 <!-- ========================= scroll-top ========================= -->

 <!-- ========================= JS here ========================= -->

 <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/tiny-slider.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>



 <script>
     const csrf_token = "{{ csrf_token() }}";
 </script>

 <script src="{{ asset('frontend/assets/js/cart.js') }}"></script>

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script>
     $.noConflict();
     jQuery(document).ready(function($) {
         $("#search").autocomplete({
             source: function(request, response) {
                 // Send an AJAX request to fetch matching product data
                 $.ajax({
                     url: "{{ route('products.autocomplete') }}", // Replace with the actual route
                     dataType: "json",
                     data: {
                         term: request.term,
                     },
                     success: function(data) {
                         var mappedData = $.map(data, function(item) {
                             // Create a custom HTML element for each suggestion
                             var suggestionHtml =
                                 '<div class="product-suggestion">' +
                                 '<div class="product-image-container">' +
                                 '<img width="50" height="50" src="' + item
                                 .image_url +
                                 '" class="product-image" alt="Product Image">' +
                                 '</div>' +
                                 '<div class="product-details">' +
                                 '<div class="product-name">' + item.name +
                                 '</div>' +
                                 '</div>' +
                                 '</div>';
                             return {
                                 label: item
                                     .name, // Displayed in the autocomplete dropdown
                                 value: item
                                     .id, // Value placed in the input field when selected
                                 html: suggestionHtml, // Custom HTML for the suggestion
                                 slug: item.slug,
                             };
                         });
                         // Display autocomplete suggestions with custom HTML
                         response(mappedData);
                     },
                 });
             },
             minLength: 1,
             position: {
                 my: "left top+5",
                 at: "left bottom",
             },
             width: 300, // Adjust the width as needed
             autoFill: true,
             select: function(event, ui) {
                 $("#search").val(ui.item.label); // Set the product name in the input field
                 // Navigate to the product details page
                 window.location.href = "{{ route('products.show_product', '') }}/" + ui.item.slug;
                 // Prevent the default behavior of the autocomplete widget
                 return false;
             },
         }).data("ui-autocomplete")._renderItem = function(ul, item) {
             // Append the custom HTML to the autocomplete dropdown
             return $("<li>")
                 .append(item.html)
                 .appendTo(ul);
         };
     })
 </script>


 <script>
     const navLinks = document.querySelectorAll('.nav-item a');

     navLinks.forEach(link => {
         link.addEventListener('click', function() {
             // Remove active class from all links
             navLinks.forEach(link => link.classList.remove('active'));

             // Add active class to the clicked link
             this.classList.add('active');
         });
     });
 </script>



 @stack('scripts')

 </body>

 </html>
