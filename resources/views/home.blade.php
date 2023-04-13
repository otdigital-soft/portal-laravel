<!doctype html>
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME', 'Shifft Homepage') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->
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
    <link rel="stylesheet" href="{{ asset('assets/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <style>
        .tg-feature {
            width: 100%;
            float: left;
            position: relative;
            padding: 20px 20px 20px 20px;
            text-align: center;
            cursor: pointer;
        }

        .tg-featureicon {
            top: 20px;
            left: 15px;
            width: 100%;
            height: 66px;
            font-size: 25px;
            line-height: 64px;
            border-radius: 0;
            position: initial;
            text-align: center;
            border: 1px solid #dbdbdb;
            margin: 0 auto 30px;
        }

        .tg-title {
            width: 100%;
            float: left;
            padding: 0 0 20px;
            text-align: center;
        }

        .tg-feature .tg-title h3 {
            margin: 0;
            width: 100%;
            display: block;
            overflow: hidden;
            font-size: 18px;
            line-height: 18px;
            text-align: center;
            white-space: nowrap;
            -o-text-overflow: ellipsis;
            text-overflow: ellipsis;
        }

        .project-grid {
            max-height: 470px;
            min-height: 470px;
        }

        .project-contents {
            min-height: 450px;
        }

        .project-image {
            margin-bottom: 10px;
            max-height: 350px;
        }

        .project-image img {
            margin-bottom: 10px;
            max-height: 338px;
        }
    </style>
</head>

<body>
    <!--************************************
			Wrapper Start
	*************************************-->
    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!--************************************
				Header Start
		*************************************-->
        <header id="tg-header" class="tg-header tg-haslayout">
            <div class="tg-topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="tg-navcurrency">
                                <!-- <li><a href="#" data-toggle="modal" data-target="#tg-modalselectcurrency">select currency</a></li> -->
                                <!-- <li><a href="#" data-toggle="modal" data-target="#tg-modalpriceconverter">Price converter</a></li> -->
                            </ul>
                            <div class="dropdown tg-themedropdown tg-userdropdown">
                                <a href="javascript:void(0);" id="tg-adminnav" class="tg-btndropdown" data-toggle="dropdown">
                                    @if(Auth::user()->image_path != null)
                                        <span class="tg-userdp" style="width: 40px; height: 40px;"><img src="{{ asset(Auth::user()->image_path) }}" alt="image description"></span>
                                    @else
                                        <span class="tg-userdp"><img src="{{ asset('assets/images/author/img-01.jpg') }}" alt="image description"></span>
                                    @endif
                                    <span class="tg-name">Hi! {{ Auth::user()->first_name }}</span>
                                    <span class="tg-role">{{ optional(auth()->user()->role)->name ?? auth()->user()->type }}</span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-adminnav">
                                    <li>
                                        <a href="/user/profile">
                                            <i class="icon-profile"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                            <i class="icon-exit"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tg-navigationarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <strong class="tg-logo"><a href="{{ route('home') }}"><img src="https://res.cloudinary.com/dxkd6xlpq/image/upload/c_scale,q_auto:best,w_200/v1677214607/logos/logo%20text/Black_Shifft_Text_Cropped.png" alt="SHIFFT Logo"></a></strong>
                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                    <ul>
                                        <li class="">
                                            <a href="{{ route('home') }}">Home</a>
                                        </li>
                                        <li class="">
                                            <a href="{{ route('referrer.index') }}">Invite Friends @if ($pendingReferrals ?? '' > 0) <span class="badge badge-pill badge-danger">{{ $pendingReferrals }}</span> @endif</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--************************************
				Header End
		*************************************-->

        <!--************************************
				Main Start
		*************************************-->
        <main id="tg-main" class="tg-main tg-haslayout">
            <!--************************************
					Cards Start
			*************************************-->
            <section class="tg-sectionspace tg-haslayout">
                <div class="">
                    <div class="">
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-push-2 col-lg-8">
                            <div class="tg-sectionhead tg-sectionheadvtwo">
                                <div class="tg-title">
                                    <h2>Why We Are Best</h2>
                                </div>
                                <div class="tg-description">
                                    <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore etae magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ea commodo consequat.</p>
                                </div>
                            </div>
                        </div> -->
                        <div class="tg-features">
                            @foreach($projects as $project)
                            <li class="project-grid">
                                <a href="{{ route('home.project', $project->slug) }}">
                                    <div class="tg-feature project-contents">
                                        <div class="project-image">
                                            @if ($project->image_path != null)
                                            <img src="{{ asset($project->image_path) }}" alt="">
                                            @else
                                            <img src="{{ asset('mountain_images/information.webp') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="tg-title">
                                            <h3><a href="{{ route('home.project', $project->slug) }}">{{ strtoupper($project->title) }}</a></h3>
                                        </div>
                                        <div class="tg-description">
                                            <p>{{ Str::limit($project->description, 50, '...') }}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                            <li class="project-grid">
                                <a href="{{ route('marketplace') }}">
                                    <div class="tg-feature project-contents">
                                        <div class="project-image">
                                            <img src="{{ asset('mountain_images/marketplace.webp') }}" alt="">
                                        </div>
                                        <div class="tg-title">
                                            <h3><a href="{{ route('marketplace') }}">SHIFFT MARKETPLACE</a></h3>
                                        </div>
                                        <div class="tg-description">
                                            <p>Where buyers and sellers come together to conduct transactions</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="project-grid">
                                <a href="{{ route('calendar') }}">
                                    <div class="tg-feature project-contents">
                                        <div class="project-image">
                                            <img src="{{ asset('mountain_images/calendar.webp') }}" alt="">
                                        </div>
                                        <div class="tg-title">
                                            <h3><a href="{{ route('calendar') }}">SHIFFT CALENDAR</a></h3>
                                        </div>
                                        <div class="tg-description">
                                            <p>Organize and track time, typically divided into days, weeks, months, and years</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            </section>
            <!--************************************
					Cards End
			*************************************-->
        </main>
        <!--************************************
				Main End
		*************************************-->

    </div>
    <!--************************************
			Wrapper End
	*************************************-->

    <script src="{{ asset('assets/js/vendor/jquery-library.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en">
    </script> -->
    <script src="{{ asset('assets/js/tinymce/tinymce.min4bb5.js?apiKey=4cuu2crphif3fuls3yb1pe4qrun9pkq99vltezv2lv6sogci') }}">
    </script>
    <script src="{{ asset('assets/js/responsivethumbnailgallery.js') }}"></script>
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
</body>

</html>
