<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
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
                            @if(optional(auth()->user()->role)->name == 'leader' || optional(auth()->user()->role)->name == 'admin')
                            <a class="tg-btn mr-2" href="{{ route('blog-posts.create', $post->project->id) }}">
                                <i class="icon-bookmark"></i>
                                <span>Post Article</span>
                            </a>
                            <a class="tg-btn mr-2" href="{{ route('events.create', $post->project->id) }}">
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
                                <li class="tg-active">Project</li>
                                <li class="tg-active">Blog Post Details</li>
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
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-post tg-detail tg-postdetail">
                                    <div class="tg-posttitle">
                                        <h1></h1>
                                    </div>
                                    <ul class="tg-postmetadata">
                                        <li><time datetime="2011-01-12">{{ $post->created_at->format('Y-m-d') }}</time></li>
                                        <li>By: <a href="javascript:void(0);">{{ $post->creator->name }}</a></li>
                                        <!-- <li><i class="icon-bubble"></i><a href="javascript:void(0);">15642</a></li> -->
                                    </ul>
                                    <!-- <div class="tg-share">
                                        <strong>share:</strong>
                                        <ul class="tg-socialicons">
                                            <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                            <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                            <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                            <li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- <figure> -->
                                        @if ($post->image_path != null)
                                        <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset($post->image_path) }}" alt="image description">
                                        @else
                                        <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset('assets/images/post/img-19.jpg') }}" alt="image description">
                                        @endif
                                    <!-- </figure> -->
                                    <!-- <ul class="tg-postcategories">
                                        <li><a href="javascript:void(0);">Lifestyle</a></li>
                                        <li><a href="javascript:void(0);">Entertainment</a></li>
                                    </ul> -->
                                    <div class="tg-description">
                                        {!! $post->content !!}
                                    </div>
                                </div>
                                <div class="tg-author">
                                    <figure>
                                        @if($post->creator->image_path != null )
                                        <a href="javascript:void(0);"><img style="width:80px;height:80px;" src="{{ asset($post->creator->image_path) }}" alt="image description"></a>
                                        @else
                                        <a href="javascript:void(0);"><img src="{{ asset('assets/images/author/img-07.jpg') }}" alt="image description"></a>
                                        @endif
                                    </figure>
                                    <div class="tg-authorcontent">
                                        <div class="tg-authorhead">
                                            <div class="tg-boxleft">
                                                <h3><a href="javascript:void(0);">{{ $post->creator->name }}</a></h3>
                                                <!-- <span>Author Since: June 27, 2017</span> -->
                                            </div>
                                            <div class="tg-boxright">
                                                <ul class="tg-socialicons">
                                                    <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                                    <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                                    <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                                    <!-- <li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li> -->
                                                    <!-- <li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tg-description">
                                            <p>Short storu about author</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div id="tg-comments" class="tg-comments">
                                    <h2>03 Comments</h2>
                                    <ul>
                                        <li>
                                            <div class="tg-author">
                                                <figure>
                                                    <a href="javascript:void(0);"><img src="images/author/img-04.jpg" alt="image description"></a>
                                                    <i class="fa fa-bolt"></i>
                                                </figure>
                                                <div class="tg-authorcontent">
                                                    <div class="tg-authorhead">
                                                        <div class="tg-boxleft">
                                                            <h3><a href="javascript:void(0);">Lurlene Cashman</a></h3>
                                                            <span>Author Since: June 27, 2017</span>
                                                        </div>
                                                        <div class="tg-boxright">
                                                            <a class="tg-btnreply" href="javascript:void(0);"><i class="fa fa-mail-reply"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="tg-description">
                                                        <p>Incididunt ut labore elore lokate magna aliqua enim adminim sitae veniam quis nostrud acitation ullamcoaris nisiutia aliquip ex ea commodo consequat aute irure dolor reprehenderit inoluptate velitita esse cillum dolore eu fugiat nulla pariatur enim.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="tg-child">
                                                <li>
                                                    <div class="tg-author">
                                                        <figure><a href="javascript:void(0);"><img src="images/author/img-05.jpg" alt="image description"></a></figure>
                                                        <div class="tg-authorcontent">
                                                            <div class="tg-authorhead">
                                                                <div class="tg-boxleft">
                                                                    <h3><a href="javascript:void(0);">Lurlene Cashman</a></h3>
                                                                    <span>Author Since: June 27, 2017</span>
                                                                </div>
                                                                <div class="tg-boxright">
                                                                    <a class="tg-btnreply" href="javascript:void(0);"><i class="fa fa-mail-reply"></i></a>
                                                                </div>
                                                            </div>
                                                            <div class="tg-description">
                                                                <p>Incididunt ut labore elore lokate magna aliqua enim adminim sitae veniam quis nostrud acitation ullamcoaris nisiutia aliquip ex ea commodo consequat aute irure dolor reprehenderit inoluptate velitita esse cillum dolore eu fugiat nulla pariatur enim.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tg-replaybox">
                                    <h2>Leave Your Comment</h2>
                                    <form class="tg-formtheme tg-formreply">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group tg-inputwithicon">
                                                        <i class="icon-user"></i>
                                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group tg-inputwithicon">
                                                        <i class="icon-envelope"></i>
                                                        <input type="text" name="name" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group tg-inputwithicon">
                                                        <i class="icon-bullhorn"></i>
                                                        <input type="text" name="name" class="form-control" placeholder="Subject">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group tg-inputwithicon">
                                                        <i class="icon-bubble"></i>
                                                        <textarea class="form-control" placeholder="Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <button class="tg-btn" button="button">Submit</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                            <aside id="tg-sidebar" class="tg-sidebar">
                                <!-- <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>By Title/Keyword</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <form class="tg-formtheme tg-formsearch">
                                            <fieldset>
                                                <div class="form-group tg-inputwithicon">
                                                    <i class="icon-magnifier"></i>
                                                    <input type="search" name="search" class="form-control" placeholder="Search Title/Keyword">
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div> -->
                                <!-- <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>By Category</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Wordpress</span>
                                                    <span>120385</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Joomla</span>
                                                    <span>86425</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Html</span>
                                                    <span>42346</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>CSS</span>
                                                    <span>7562</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>Jquery</span>
                                                    <span>214523</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>PSD Template</span>
                                                    <span>62732</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <span>All</span>
                                                    <span>12512331</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tg-widget tg-widgettrendingposts">
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
                                </div> -->
                                <!-- <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>Other Posts</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <div id="tg-trendingpostsslider" class="tg-trendingpostsslider owl-carousel">
                                            <div class="tg-post">
                                                <figure>
                                                    <a href="javascript:void(0);"><img src="assets/images/post/img-04.jpg" alt="image description"></a>
                                                </figure>
                                                <div class="tg-postcontent">
                                                    <ul class="tg-postcategories">
                                                        <li><a href="javascript:void(0);">Lifestyle</a></li>
                                                        <li><a href="javascript:void(0);">Entertainment</a></li>
                                                    </ul>
                                                    <div class="tg-posttitle">
                                                        <h3><a href="javascript:void(0);">Top 10 Characters in 2017</a></h3>
                                                    </div>
                                                    <ul class="tg-postmetadata">
                                                        <li>By: <a href="javascript:void(0);">Terisa Wallick</a></li>
                                                        <li><i class="icon-bubble"></i><a href="javascript:void(0);">15642</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
