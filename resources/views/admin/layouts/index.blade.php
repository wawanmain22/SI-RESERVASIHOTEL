<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    @vite([])
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.layouts.partials.navbar')
            @include('admin.layouts.partials.sidebar')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <!-- add content here -->
                        @yield('main')
                    </div>
                </section>
                @include('admin.layouts.partials.setting-sidebar')
            </div>
            @include('admin.layouts.partials.footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraries -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Simpan pengaturan tema
            $(".layout-color input:radio").change(function() {
                localStorage.setItem("layoutColor", $(this).val());
                // Logika pengaturan tema lainnya...
            });

            // Simpan pengaturan sticky header
            $("#sticky_header_setting").change(function() {
                localStorage.setItem("stickyHeader", $(this).is(":checked"));
                // Logika pengaturan sticky header lainnya...
            });

            // Simpan pengaturan sidebar mini
            $("#mini_sidebar_setting").change(function() {
                localStorage.setItem("miniSidebar", $(this).is(":checked"));
                // Logika pengaturan sidebar mini lainnya...
            });
        });

        $(document).ready(function() {
            // Muat pengaturan tema
            var savedLayoutColor = localStorage.getItem("layoutColor");
            if (savedLayoutColor) {
                $(".layout-color input:radio[value='" + savedLayoutColor + "']")
                    .prop("checked", true)
                    .change();
            }

            // Muat pengaturan sticky header
            var savedStickyHeader = localStorage.getItem("stickyHeader");
            if (savedStickyHeader !== null) {
                $("#sticky_header_setting")
                    .prop("checked", savedStickyHeader === "true")
                    .change();
            }

            // Muat pengaturan sidebar mini
            var savedMiniSidebar = localStorage.getItem("miniSidebar");
            if (savedMiniSidebar !== null) {
                $("#mini_sidebar_setting")
                    .prop("checked", savedMiniSidebar === "true")
                    .change();
            }
        });
    </script>
</body>

</html>
