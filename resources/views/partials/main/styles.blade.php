<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/transitions.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flags.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/prettyPhoto.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/chartist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dbresponsive.css') }}">
<script src="{{ asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
<style>
    textarea,
    input {
        text-transform: none !important;
    }

    .mr-2 {
        margin-right: 20px;
    }

    .badge.badge-pill.badge-danger {
        font-size: 0.875rem;
        /* 14px */
        font-weight: 400;
        line-height: 1.5;
        display: inline-block;
        padding: 0.375rem 0.5625rem;
        /* 6px 9px */
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 10rem;
        /* 9999px */
        background-color: #dc3545;
        /* Red color */
        color: #fff;
    }

    .nav--active {
        border-bottom: 2px solid #00cc67;
        border-left: 2px solid #00cc67;
    }

    .inner-nav--active::before {
        background: #00cc67 !important;
    }

    .inner-nav--active a {
        color: #00cc67 !important;
    }

    .bg-label-success {
        background-color: #5cb85c;
    }

    .bg-label-warning {
        background-color: #f0ad4e;
    }


    .bg-label-danger {
        background-color: #e61616;
    }

    .bg-label-default {
        background-color: #999;
    }

    .text-white {
        color: #fff;
    }
</style>
<link href="https://unpkg.com/treeflex/dist/css/treeflex.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
@yield('styles')
