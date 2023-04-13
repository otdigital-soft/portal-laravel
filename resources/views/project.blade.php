<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .mr-2 {
            margin-right: 20px;
        }

        .mb-2 {
            margin-bottom: 20px !important;
        }

        .tg-like {
            background-color: #363b4d;
        }

        .tg-like i {
            color: #fff;
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
                            @if(optional(auth()->user()->role)->name == 'leader')
                            <a class="tg-btn mr-2" href="{{ route('blog-posts.create', $project->id) }}">
                                <i class="icon-bookmark"></i>
                                <span>Post Article</span>
                            </a>
                            <a class="tg-btn mr-2" href="{{ route('events.create', $project->id) }}">
                                <i class="icon-calendar"></i>
                                <span>Create Event</span>
                            </a>
                            @endif
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
                                            <a href="{{ route('referrer.index') }}">Invite Friends @if ($pendingReferrals ??
                                                '' > 0) <span class="badge badge-pill badge-danger">{{ $pendingReferrals
                                                    }}</span> @endif</a>
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
				Home Slider Start
		*************************************-->
        <div id="tg-innerbanner" class="tg-innerbanner tg-haslayout">
            <div class="tg-breadcrumbarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ol class="tg-breadcrumb">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="tg-active">{{ $project->id > 7 ? 'Project' : 'Mountain' }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
				Home Slider End
		*************************************-->
        <!--************************************
				Main Start
		*************************************-->
        <main id="tg-main" class="tg-main tg-haslayout">
            <!--************************************
					About Us Start
			*************************************-->
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-sellercontact">
                            <div class="tg-memberinfobox">
                                <div class="tg-memberinfo">
                                    {{-- @if ($project->image_path != null)
                                    <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset($project->image_path) }}" alt="image description">
                                    @else
                                    <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset('assets/images/post/img-19.jpg') }}" alt="image description">
                                    @endif --}}

                                    <div class="project-image" style="height: 400px; background-image:url({{ url($project->image_path) }}); background-size: cover; background-position: center; margin-bottom: 20px">

                                    </div>
                                    <h3 class="mb-2"><a href="javascript:void(0);">{{ $project->title }}</a></h3>
                                    <span>{{ $project->description }}</span>
                                    {{-- <a class="tg-btnseeallads" href="javascript:void(0);">See All Ads</a> --}}
                                </div>
                            </div>
                            @php
                                $likedStatus = '';
                                $icon = 'fa fa-bell';
                                $likedText = 'Subscribe';
                                if (Auth::user() && Auth::user()->subscribedProjects->contains($project)) {
                                    $likedStatus = 'tg-liked';
                                    $icon = 'fa fa-bell-slash';
                                    $likedText = 'Unsubscribe';
                                }
                            @endphp
                            <span id="add-to-subscriptions" class="tg-like {{ $likedStatus }}" data-project-id="{{ $project->id }}"><i class="{{ $icon }}">{{ $likedText }}</i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-sectionhead">
                                    <div class="tg-title">
                                        <h2>Blog Posts on this Project</h2>
                                    </div>
                                    <div class="tg-description">
                                        <p>Stay Updated With News</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="tg-posts tg-postslist">
                                        @forelse ($project->blogPosts as $post)
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="tg-post">
                                                <figure>
                                                    @if ($post->image_path != null)
                                                    <a href="javascript:void(0);"><img style="width: 150px; height: 150px;" src="{{ asset($post->image_path) }}"
                                                            alt="image description"></a>
                                                    </figure>
                                                    @else
                                                    <a href="javascript:void(0);"><img style="width: 150px; height: 150px;" src="{{ asset('assets/images/post/img-07.jpg') }}"
                                                            alt="image description"></a>
                                                    </figure>
                                                    @endif

                                                <div class="tg-postcontent">
                                                    {{-- <ul class="tg-postcategories">
                                                        <li><a href="javascript:void(0);">Lifestyle</a></li>
                                                        <li><a href="javascript:void(0);">Entertainment</a></li>
                                                    </ul> --}}
                                                    <div class="tg-posttitle">
                                                        <h3><a href="{{ route('blog-posts.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                                    </div>
                                                    <ul class="tg-postmetadata">
                                                        <li>By: {{ $post->creator->name
                                                                }}</li>
                                                        {{-- <li><i class="icon-bubble"></i><a
                                                                href="javascript:void(0);">15642</a></li> --}}
                                                    </ul>
                                                    <div class="tg-description">
                                                        <p>{{ Str::limit(strip_tags($post->content), 100, '...') }} <br>
                                                            <a href="{{ route('blog-posts.show', $post->slug) }}">Read
                                                                more</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        {{ 'No blog post yet' }}
                                        @endforelse
                                    </div>
                                </div>
                                <nav class="tg-pagination">

                                </nav>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                            <aside id="tg-sidebar" class="tg-sidebar">
                                <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>Project Events</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            @forelse ($project->events as $event)
                                            <li>
                                                <a href="{{ route('events.show', $event) }}">
                                                    <span>{{ Str::limit($event->name, 20, '...') }}</span>
                                                    <span>{{ $event->date }}</span>
                                                </a>
                                            </li>
                                            @empty
                                            {{ 'No events' }}
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                {{-- <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>By Posts Type</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Featured Posts</span>
                                                    <span>987327</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Regular Posts</span>
                                                    <span>48952413</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                                {{-- <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>Most Reads</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <div id="tg-trendingpostsslider" class="tg-trendingpostsslider owl-carousel">
                                            @forelse($project->blogPosts as $post)
                                            <div class="tg-post">
                                                <figure>
                                                    <a href="javascript:void(0);"><img
                                                            src="{{ asset('assets/images/post/img-04.jpg')}}"
                                alt="image description"></a>
                                </figure>
                                <div class="tg-postcontent">
                                    <ul class="tg-postcategories">
                                        <li><a href="javascript:void(0);">Lifestyle</a></li>
                                        <li><a href="javascript:void(0);">Entertainment</a></li>
                                    </ul>
                                    <div class="tg-posttitle">
                                        <h3><a href="javascript:void(0);">Top 10 Characters in 2017</a>
                                        </h3>
                                    </div>
                                    <ul class="tg-postmetadata">
                                        <li>By: <a href="javascript:void(0);">Terisa Wallick</a></li>
                                        <li><i class="icon-bubble"></i><a href="javascript:void(0);">15642</a></li>
                                    </ul>
                                </div>
                        </div>
                        @empty
                        {{ 'No blog posts.' }}
                        @endforelse
                    </div>
                </div>
            </div> --}}
            </aside>
    </div>
    </div>
    </div>
    </div>
    <!--************************************
					About Us End
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
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let addToSubscriptionsBtn = document.querySelector('#add-to-subscriptions');
        let projectId = addToSubscriptionsBtn.getAttribute('data-project-id');
        addToSubscriptionsBtn.addEventListener('click', () => {
            const url = `{{ url('projects/${projectId}/favorite') }}`
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.on_subscription) {
                        addToSubscriptionsBtn.classList.add('tg-liked');
                        // addToSubscriptionsBtn.textContent = 'Unsubscribe';
                        addToSubscriptionsBtn.innerHTML = `<i class="fa fa-bell-slash">Unsubscribe</i>`;
                    } else {
                        addToSubscriptionsBtn.classList.remove('tg-liked');
                        addToSubscriptionsBtn.innerHTML = `<i class="fa fa-bell">Subscribe</i>`;
                    }
                });
        });
    </script>
</body>

</html>
