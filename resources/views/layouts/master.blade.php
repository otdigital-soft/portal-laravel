<!doctype html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shifft Marketplace</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="apple-touch-icon" href="apple-touch-icon.png"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.master.styles')
</head>

<body class="tg-home tg-homeone">
    <!--************************************
			Wrapper Start
	*************************************-->
    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!--************************************
				Header Start
		*************************************-->
        <header id="tg-header" class="tg-header tg-haslayout">
            @include('partials.master.topbar')
            @include('partials.master.navigation')
        </header>
        <!--************************************
				Header End
		*************************************-->
        <!--************************************
				Home Slider Start
		*************************************-->
        <div id="tg-homebanner" class="tg-homebanner tg-haslayout">
            <figure class="item" data-vide-bg="poster: " data-vide-options="position: 50% 50%">
                <figcaption>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="tg-bannercontent">
                                    <h1>Shifft Marketplace</h1>
                                    <h2>Explore {{ count($ads) }} Products and Services from Verified Shifft Community Members</h2>
                                    <form class="tg-formtheme tg-formbannersearch">
                                        <fieldset>
                                            <div class="form-group tg-inputwithicon">
                                                <i class="icon-bullhorn"></i>
                                                <input type="text" name="title" class="form-control" placeholder="What are you looking for">
                                            </div>
                                            <div class="form-group tg-inputwithicon">
                                                <i class="icon-location"></i>
                                                <a class="tg-btnsharelocation fa fa-crosshairs" href="javascript:void(0);"></a>
                                                <div class="tg-select">
                                                    <select name="location_id">
                                                        <option value="" disabled selected>Select Location</option>
                                                        @foreach($locations as $location)
                                                        <option value="{{ $location->id }}">{{ $location->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group tg-inputwithicon">
                                                <i class="icon-layers"></i>
                                                <div class="tg-select">
                                                    <select name="category_id">
                                                        <option value="" disabled selected>Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option disabled value="{{ $category->id }}" class="category-option">-- {{ $category->name }} --</option>
                                                        @foreach($category->subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}"> {{ $subcategory->name }}</option>
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="tg-btn" type="submit">Search Now</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </figcaption>
            </figure>
        </div>
        <!--************************************
				Home Slider End
		*************************************-->
        <!--************************************
				Main Start
		*************************************-->
        <main id="tg-main" class="tg-main tg-haslayout">
            @yield('content')
        </main>
        <!--************************************
				Main End
		*************************************-->
        {{-- @include('partials.master.footer') --}}
    </div>
    <!--************************************
			Wrapper End
	*************************************-->
    @include('partials.master.scripts')
</body>

</html>
