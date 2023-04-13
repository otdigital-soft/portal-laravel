@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form class="tg-formtheme tg-formdashboard">
            <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>Favorite Ads</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <nav class="tg-navtabledata">
                                <ul>
                                    <li class="tg-active"><a href="_.html">Favorite Ads ({{ count($ads)}})</a></li>
                                </ul>
                            </nav>
                            <div class="tg-otherfilters">
                                <div class="row">
                                    <!-- <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 pull-left">
                                        <div class="form-group tg-sortby">
                                            <span>Sort by:</span>
                                            <div class="tg-select">
                                                <select>
                                                    <option>Most Recent</option>
                                                    <option>Most Recent</option>
                                                    <option>Most Recent</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 pull-right">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="icon-magnifier"></i>
                                            <input type="search" name="search" id="search-input" class="form-control" placeholder="Search Here" onkeydown="filterAds()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="tg-adstype" class="table tg-dashboardtable tg-tablemyads">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="tg-checkbox">
                                                <!-- <input id="tg-checkedall" type="checkbox" name="myads" value="checkall"> -->
                                                #
                                                <label for="tg-checkedall"></label>
                                            </span>
                                        </th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Price &amp; Location</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ads as $ad)
                                    <tr data-category="active">
                                        <td data-title="">
                                            <span class="tg-checkbox">
                                                <span>{{ $loop->iteration }}</span>
                                                <label for="tg-adone"></label>
                                            </span>
                                        </td>
                                        <td data-title="Photo">
                                            @if (count($ad->images) > 0)
                                            <img src="{{ asset($ad->images[0]->filename) }}" alt="image description" width="150">
                                            @else
                                            {{ 'No Image'}}
                                            @endif
                                        </td>
                                        <td data-title="Title">
                                            <h3>{{ $ad->title }}</h3>
                                            {{-- <span>Ad ID: ng3D5hAMHPajQrM</span> --}}
                                        </td>
                                        <td data-title="Category"><span class="tg-adcategories">{{
                                                $ad->subcategory->name ?? ''}}</span>
                                        </td>
                                        <td data-title="Price &amp; Location">
                                            <h3>${{ $ad->price }}</h3>
                                            @foreach($ad->locations as $location)
                                            <address>{{ $location->name ?? ''}}
                                            </address>
                                            @endforeach

                                        </td>
                                        <td data-title="Action">
                                            <div class="tg-btnsactions">
                                                <span class="tg-btnaction tg-btnactiondelete tg-like {{ Auth::user() && Auth::user()->favorites->contains($ad) ? 'tg-liked' : '' }} add-to-favorites" data-ad-id="{{ $ad->id }}" style="top:auto; right:auto"><i class="fa fa-heart"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{ 'You don\'t have any Favorite Ads'}}
                                    @endforelse
                                </tbody>
                            </table>
                            <nav class="tg-pagination">
                                {{ $ads->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script>
    let addToFavoritesBtns = document.querySelectorAll('.add-to-favorites');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    addToFavoritesBtns.forEach(addToFavoritesBtn => {
        let adId = addToFavoritesBtn.getAttribute('data-ad-id');
        addToFavoritesBtn.addEventListener('click', () => {
            console.log('i clicked o');
            const url = `{{ url('user/ads/${adId}/favorite') }}`
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.is_favorite) {
                        addToFavoritesBtn.classList.add('tg-liked');
                    } else {
                        addToFavoritesBtn.classList.remove('tg-liked');
                    }
                });
        });
    });

    function filterAds() {
        // Get the search input value
        var input = document.getElementById("search-input");
        var filter = input.value.toLowerCase();

        // Get the table rows
        var rows = document.getElementsByTagName("tr");

        // Loop through the rows and hide/show them based on the search input value
        for (var i = 0; i < rows.length; i++) {
            var title = rows[i].getElementsByTagName("td")[2];
            if (title) {
                if (title.innerText.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>

@endsection
