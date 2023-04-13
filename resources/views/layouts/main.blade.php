<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shifft Marketplace</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.main.styles')
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!--************************************
			Wrapper Start
	*************************************-->
    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!--************************************
				Header Start
		*************************************-->
        <header id="tg-dashboardheader" class="tg-dashboardheader tg-haslayout">
            {{-- Navigations --}}
            @include('partials.main.navigation')

            <div class="tg-rghtbox">
                <a class="tg-btn mr-2" href="{{ route('user.ads') }}">
                    <!-- <i class="icon-bookmark"></i> -->
                    <span>My Ads</span>
                </a>
                <a class="tg-btn" href="{{ route('ads.create') }}">
                    <i class="icon-bookmark"></i>
                    <span>post an ad</span>
                </a>
                {{-- <div class="dropdown tg-themedropdown tg-notification">
                    <button class="tg-btndropdown" id="tg-notificationdropdown" type="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon-alarm"></i>
                        <span class="tg-badge">9</span>
                    </button>
                    <ul class="dropdown-menu tg-dropdownmenu" aria-labelledby="tg-notificationdropdown">
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                        <li>
                            <p>Consectetur adipisicing sedi eiusmod ampore incididunt ut labore et dolore.</p>
                        </li>
                    </ul>
                </div> --}}
            </div>
            {{-- Sidebar Navigations --}}
            @include('partials.main.sidenav')
        </header>
        <!--************************************
				Header End
		*************************************-->
        <!--************************************
				Dashboard Banner Start
		*************************************-->
        <div class="tg-dashboardbanner">
            <h1>Dashboard</h1>
            <ol class="tg-breadcrumb">
                <li><a href="javascript:void(0);">Main</a></li>
                <li class="tg-active">Dashboard</li>
            </ol>
        </div>
        <!--************************************
				Dashboard Banner End
		*************************************-->
        <!--************************************
				Main Start
		*************************************-->
        <main id="tg-main" class="tg-main tg-haslayout">
            <!--************************************
					Dashboard Alerts Start
			*************************************-->
            @include('partials.main.alert')
            <!--************************************
					Dashboard Alerts End
			*************************************-->
            <!--************************************
					Section Start
			*************************************-->
            @yield('content')
            <!--************************************
					Section End
			*************************************-->
        </main>
        <!--************************************
				Main End
		*************************************-->
        <!--************************************
				Footer Start
		*************************************-->
        <footer id="tg-footer" class="tg-footer tg-haslayout">
            <nav class="tg-footernav">
                <ul>
                    {{-- <li><a href="javascript:void(0);">Listing Policy</a></li>
                    <li><a href="javascript:void(0);">Terms of Use</a></li>
                    <li><a href="javascript:void(0);">Privacy Policy</a></li> --}}
                </ul>
            </nav>
            {{-- <span class="tg-copyright">2017 All Rights Reserved &copy; </span> --}}
        </footer>
        <!--************************************
				Footer End
		*************************************-->
    </div>
    <!--************************************
			Wrapper End
	*************************************-->
    <div id="modal-edit-ad" class="modal fade tg-thememodal tg-modalmakeanoffer" tabindex="-1" role="dialog">
        <div class="modal-dialog tg-thememodaldialog" role="document">
            <button type="button" class="tg-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <div class="modal-content tg-thememodalcontent">
                <div class="tg-title">
                    <strong>Edit Ad</strong>
                </div>
                <form action="{{ route('user.ad.update') }}" method="POST" enctype="multipart/form-data" class="tg-formtheme tg-formmakeanoffer">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="ad_id">
                    <fieldset>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-user"></i>
                            <input type="text" name="title" class="form-control" placeholder="Ad Title*" required>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-tag"></i>
                            <input type="text" name="price" class="form-control" placeholder="Price*" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Image:</label>
                            <div class="d-flex flex-column align-items-start">
                                <img id="ad-image-preview" src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="{{ 'No Image' }}" onerror="this.style.display='none'" style="max-width: 100%;">
                                <input type="file" id="edit_image" class="form-control-file" name="image">
                            </div>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-bubble"></i>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="tg-btn" type="submit">Update</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-edit-event" class="modal fade tg-thememodal tg-modalmakeanoffer" tabindex="-1" role="dialog">
        <div class="modal-dialog tg-thememodaldialog" role="document">
            <button type="button" class="tg-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <div class="modal-content tg-thememodalcontent">
                <div class="tg-title">
                    <strong>Edit Event</strong>
                </div>
                <form action="{{ route('events.update') }}" method="POST" enctype="multipart/form-data" class="tg-formtheme tg-formmakeanoffer">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="event_id">
                    <input type="hidden" name="project_id">
                    <fieldset>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-user"></i>
                            <input type="text" name="name" class="form-control" placeholder="Event Title*" required>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-clock"></i>
                            <input type="datetime-local" name="start_time" class="form-control" placeholder="Start Time*" required>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-clock"></i>
                            <input type="datetime-local" name="end_time" class="form-control" placeholder="End Time*" required>
                        </div>

                        <div class="form-group tg-inputwithicon">
                            <i class="icon-bubble"></i>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="tg-btn" type="submit">Update</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-edit-project" class="modal fade tg-thememodal tg-modalmakeanoffer" tabindex="-1" role="dialog">
        <div class="modal-dialog tg-thememodaldialog" role="document">
            <button type="button" class="tg-close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
            <div class="modal-content tg-thememodalcontent">
                <div class="tg-title">
                    <strong>Edit Project</strong>
                </div>
                <form action="{{ route('project.update') }}" method="POST" enctype="multipart/form-data"
                    class="tg-formtheme tg-formmakeanoffer">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="project_id">
                    <fieldset>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-user"></i>
                            <input type="text" name="title" class="form-control" placeholder="Project Title*" required>
                        </div>
                        <div class="form-group tg-inputwithicon">
                            <i class="icon-bubble"></i>
                            <textarea name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_project_image">Image:</label>
                            <div class="d-flex flex-column align-items-start">
                                <img id="project-image-preview" src="{{ asset('assets/images/ads/img-01.jpg') }}"
                                    alt="{{ 'No Image' }}" onerror="this.style.display='none'" style="max-width: 100%;">
                                <input type="file" id="edit_project_image" class="form-control-file" name="image">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="tg-btn" type="submit">Update</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    @include('partials.main.scripts')
</body>

</html>
