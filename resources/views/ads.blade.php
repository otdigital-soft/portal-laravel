@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div id="tg-twocolumns" class="tg-twocolumns">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-pagehead">
                    <h1>Search Results</h1>
                    <p>{{ count($ads) }} Results on {{ Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                <aside id="tg-sidebar" class="tg-sidebar">
                    <form action="{{ route('ads.filter') }}" class="tg-formtheme tg-formnerrowsearch" method="POST">
                        @csrf
                        <div class="tg-sidebartitle">
                            <h2>Narrow Your Search:</h2>
                        </div>
                        <fieldset>
                            <div id="tg-narrowsearchcollapse" class="tg-themecollapse tg-narrowsearchcollapse">
                                <div class="tg-collapsetitle">
                                    <!-- <i class="fa fa-rotate-left"></i> -->
                                    <span class="fa fa-angle-down">By Title</span>
                                </div>
                                <div class="tg-themecollapsecontent">
                                    <div class="form-group tg-inputwithicon">
                                        <i class="icon-magnifier"></i>
                                        <input type="search" name="title" class="form-control" placeholder="Search Title/Keyword">
                                    </div>
                                </div>
                                <div class="tg-collapsetitle">
                                    <!-- <i class="fa fa-rotate-left"></i> -->
                                    <span class="fa fa-angle-down">By Category</span>
                                </div>
                                <div class="tg-themecollapsecontent">
                                    <div class="form-group">
                                        <div class="tg-select">
                                            <select id="category-select" name="category_id">
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tg-themecollapsecontent">
                                    <div class="form-group">
                                        <div class="tg-select">
                                            <select id="subcategory-select" name="subcategory_id">
                                                <option value="" selected disabled>Select Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tg-collapsetitle">
                                    <!-- <i class="fa fa-rotate-left"></i> -->
                                    <span class="fa fa-angle-down">By Location</span>
                                </div>
                                <div class="tg-themecollapsecontent">
                                    <div class="form-group">
                                        <div class="tg-select">
                                            <select name="location_id">
                                                <option value="" selected disabled>Select Location</option>
                                                @foreach($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="tg-btn">apply filter</button>
                        </fieldset>
                    </form>
                </aside>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                <div id="tg-content" class="tg-content">
                    <!-- <div class="tg-contenthead">
                        <div class="tg-sortandview">
                            <div class="tg-sortby">
                                <strong>Sort by:</strong>
                                <div class="tg-select">
                                    <select>
                                        <option value="Most Recent">Most Recent</option>
                                        <option value="Most Recent">Most Recent</option>
                                        <option value="Most Recent">Most Recent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tg-views">
                                <strong>View As Grid</strong>
                                <ul>
                                    <li class="tg-active"><a href="javascript:void(0);"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-reorder"></i></a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="tg-applyedfilters">
                            <ul>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Manchester</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>$200 - $500</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Brand New</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Featured Ads</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Area Unit: Sq. ft.</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Sq. ft. 2500 - Sq. ft.5000</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>Rooms: 04</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>2014 - 2016</span>
                                </li>
                                <li class="alert alert-dismissable fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span>1500 - 3000</span>
                                </li>
                                <li><a class="tg-btncleall" href="javascript:void(0);">Clear All</a></li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="tg-ads tg-grids">
                        <div class="row">
                            @foreach($ads as $ad)
                            <div class="col-xs-6 col-sm-12 col-md-6 col-lg-4 tg-verticaltop">
                                <div class="tg-ad tg-verifiedad">
                                    <figure>
                                        @if (count($ad->images) > 0)
                                        <a href="javascript:void(0);"><img src="{{ asset($ad->images[0]->filename) }}" alt="{{ $ad->description }}"></a>
                                        @else
                                        <a href="javascript:void(0);"><img src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="image description"></a>
                                        @endif
                                        <!-- <span class="tg-photocount">See 18 Photos</span> -->
                                    </figure>
                                    <div class="tg-adcontent">
                                        <ul class="tg-productcagegories">
                                            <li><a href="javascript:void(0);">{{ ucwords($ad->subcategory->name) }}</a>
                                            </li>
                                        </ul>
                                        <div class="tg-adtitle">
                                            <h3><a href="javascript:void(0);">{{ $ad->title }}</a></h3>
                                        </div>
                                        <time datetime="2017-06-06">Last Updated: {{ $ad->created_at->diffForHumans()
                                            }}</time>
                                        <div class="tg-adprice">
                                            <h4>${{ $ad->price }}</h4>
                                        </div>
                                        <address>{{ $ad->locations[0]->name ?? ''}}</address>
                                        <div class="tg-phonelike">
                                            <a class="tg-btnphone" href="javascript:void(0);">
                                                <i class="icon-phone-handset"></i>
                                                <span data-toggle="tooltip" data-placement="top" title="Show Phone No." data-last="0800 - 1234 - 562 - 6"><em>Show Phone No.</em></span>
                                            </a>
                                            <span class="tg-like {{ Auth::user() && Auth::user()->favorites->contains($ad) ? 'tg-liked' : '' }} add-to-favorites" data-ad-id="{{ $ad->id }}"><i class=" fa fa-heart"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tg-ads tg-adsvtwo tg-adslist hidden">
                        <div class="row">
                            @foreach($ads as $ad)
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="tg-ad tg-verifiedad">
                                    <figure>
                                        @if (count($ad->images) > 0)
                                        <a href="javascript:void(0);"><img src="{{ asset($ad->images[0]->filename) }}" alt="{{ $ad->description }}" width="100%"></a>
                                        @else
                                        <a href="javascript:void(0);"><img src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="image description"></a>
                                        @endif
                                        <!-- <span class="tg-photocount">See 18 Photos</span> -->
                                    </figure>
                                    <div class="tg-adcontent">
                                        <ul class="tg-productcagegories">
                                            <li><a href="javascript:void(0);">{{ ucwords($ad->subcategory->name) }}</a>
                                            </li>
                                        </ul>
                                        <div class="tg-adtitle">
                                            <h3><a href="javascript:void(0);">{{ $ad->title }}</a></h3>
                                        </div>
                                        <time datetime="2017-06-06">Last Updated: {{ $ad->created_at->diffForHumans()
                                            }}</time>
                                        <div class="tg-adprice">
                                            <h4>${{ $ad->price }}</h4>
                                        </div>
                                        <address>{{ $ad->locations[0]->name ?? ''}}</address>
                                        <div class="tg-phonelike">
                                            <a class="tg-btnphone" href="javascript:void(0);">
                                                <i class="icon-phone-handset"></i>
                                                <span data-toggle="tooltip" data-placement="top" title="Show Phone No." data-last="0800 - 1234 - 562 - 6"><em>Show Phone No.</em></span>
                                            </a>
                                            <span class="tg-like {{ Auth::user() && Auth::user()->favorites->contains($ad) ? 'tg-liked' : '' }} add-to-favorites" data-ad-id="{{ $ad->id }}"><i class=" fa fa-heart"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <nav class="tg-pagination">
                        {{ $ads->links() }}
                        <!-- <ul>
                            <li class="tg-prevpage"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li class="tg-active"><a href="#">5</a></li>
                            <li>...</li>
                            <li><a href="#">10</a></li>
                            <li class="tg-nextpage"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul> -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Get a reference to the category and subcategory select inputs
    const categorySelect = document.getElementById('category-select');
    const subcategorySelect = document.getElementById('subcategory-select');

    // Add an event listener to the category select input
    categorySelect.addEventListener('change', async () => {
        // Get the selected category id
        const categoryId = categorySelect.value;

        // Fetch the subcategories of the selected category using AJAX
        var url = `{{ url('api/subcategories?category_id=${categoryId}') }}`;
        const response = await fetch(url);
        const subcategories = await response.json();

        // Clear the existing options from the subcategory select input
        subcategorySelect.innerHTML = '<option value="" selected disabled>Select Sub Category</option>';

        // Add the fetched subcategories as options to the subcategory select input
        subcategories.forEach(subcategory => {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.text = subcategory.name;
            subcategorySelect.add(option);
        });
    });

    var gridButton = document.querySelector('.tg-views .fa-th-large').parentNode;
    var listButton = document.querySelector('.tg-views .fa-reorder').parentNode;
    var gridAds = document.querySelector('.tg-grids');
    var listAds = document.querySelector('.tg-adslist');

    gridButton.addEventListener('click', function() {
        gridButton.classList.add('tg-active');
        listButton.classList.remove('tg-active');
        gridAds.style.display = 'block';
        listAds.style.display = 'none';
    });

    listButton.addEventListener('click', function() {
        listButton.classList.add('tg-active');
        gridButton.classList.remove('tg-active');
        listAds.style.display = 'block';
        gridAds.style.display = 'none';
    });
</script>
@endsection
