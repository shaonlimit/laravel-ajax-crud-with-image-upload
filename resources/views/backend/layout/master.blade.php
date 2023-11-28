<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Dashboard - NiceAdmin Bootstrap Template</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- niceadmin cdn --}}
        @include("backend.layout.partials.cdn")
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- End Header -->
        @include("backend.layout.partials.navbar")
        <!-- ======= Sidebar ======= -->
        @include("backend.layout.partials.sidebar")

        <main id="main" class="main">

            @include("backend.layout.partials.page_title")
            <!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    @yield("content")

                </div>
            </section>

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        @include("backend.layout.partials.footer")
        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        @include("backend.layout.partials.script")
    </body>

</html>
