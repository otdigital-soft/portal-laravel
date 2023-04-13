<script src="{{ asset('assets/js/vendor/jquery-library.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
{{-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en">
</script> --}}
{{-- <script src="{{ asset('assets/js/tinymce/tinymce.min4bb5.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/responsivethumbnailgallery.html') }}"></script> --}}
<script src="{{ asset('assets/js/jquery.flagstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/backgroundstretch.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.vide.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.collapse.js') }}"></script>
<script src="{{ asset('assets/js/scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/js/prettyPhoto.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/countTo.js') }}"></script>
<script src="{{ asset('assets/js/appear.js') }}"></script>
<script src="{{ asset('assets/js/gmap3.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@if(Auth::check())
<script>
    // Check if user is authenticated
    // Set the window.userId variable to the authenticated user's ID
    window.userId = {{ Auth::user()->id }};
</script>
@endif

<script>
    $(document).ready(function() {
        // Listen to changes on the file input field
        $('#edit_image').change(function() {
            // Get the selected file
            const file = this.files[0];

            // Create a new FileReader object
            const reader = new FileReader();

            // Set up the FileReader object to update the image preview when the file is loaded
            reader.onload = function(e) {
                $('#ad-image-preview').attr('src', e.target.result);
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        });

        $('#edit_project_image').change(function() {
            // Get the selected file
            const file = this.files[0];

            // Create a new FileReader object
            const reader = new FileReader();

            // Set up the FileReader object to update the image preview when the file is loaded
            reader.onload = function(e) {
                $('#project-image-preview').attr('src', e.target.result);
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        });

        function collapseMenu() {
            var currentRoute = "{{ Route::currentRouteName() }}";
            var subMenu = jQuery('.tg-navdashboard ul.sub-menu');
            if (currentRoute.startsWith('category.') || currentRoute.startsWith('location.') || currentRoute.startsWith('role.') || currentRoute.startsWith('users.')) {
                subMenu.parent('.menu-item-has-children').addClass('tg-open');
                subMenu.slideDown(300);
            }
        }

        collapseMenu();
    });
</script>
@yield('scripts')
