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
            <div class="tg-navigationarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <strong class="tg-logo"><a href="{{ route('home') }}"><img
                                        src="https://res.cloudinary.com/dxkd6xlpq/image/upload/c_scale,q_auto:best,w_200/v1677214607/logos/logo%20text/Black_Shifft_Text_Cropped.png"
                                        alt="SHIFFT Logo"></a></strong>

                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#tg-navigation" aria-expanded="false">
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
                                            <a href="{{ route('referrer.index') }}">Invite Friends @if
                                                ($pendingReferrals ??
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
                                <li class="tg-active">Calendar</li>
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
                        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 pull-right">
                            <div id="tg-content" class="tg-content">
                                <div class="tg-sectionhead">
                                    <div class="tg-title">
                                        <h2>Calendar</h2>
                                    </div>
                                    <div class="tg-description">
                                        <p>Scheduled Events</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="tg-posts tg-postslist">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                            <aside id="tg-sidebar" class="tg-sidebar">
                                <div class="tg-widget tg-widgettrendingposts">
                                    <div class="tg-sidebartitle">
                                        <h2>Filter Events</h2>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <form class="tg-formtheme tg-formsearch" action="{{ route('events.calendar') }}"
                                            method="get">
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="project">Project:</label>
                                                    <select name="project" id="project" class="form-control">
                                                        <option value="">All projects</option>
                                                        @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}">
                                                            {{ $project->title }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="subscribed">Subscribed events only:</label>
                                                    <input type="checkbox" name="subscribed" id="subscribed"
                                                        value="true">
                                                </div>

                                                <div class="form-group">
                                                    <label for="all">All events:</label>
                                                    <input type="checkbox" name="all" id="all" value="true">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Apply filters</button>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
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

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.4/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'en',
                timeZone: 'local',
                events: {
                    url: '{{ route('events.getEvents ') }}',
                    method: 'GET',
                    failure: function() {
                        alert('There was an error while fetching events.');
                    }
                }
            });

            calendar.render();
        });
    </script>
</body>

</html>
