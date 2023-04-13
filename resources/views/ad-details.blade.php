@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div id="tg-twocolumns" class="tg-twocolumns">
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
                <aside id="tg-sidebar" class="tg-sidebar">
                    <div class="tg-pricebox">
                        <!-- <div id="tg-flagstrapfour" class="tg-flagstrap" data-input-name="country"></div> -->
                        <div class="tg-priceandlastupdate">
                            <span>${{ $ad->price }}</span>
                            <span>Last Updated: {{ $ad->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="tg-sellercontactdetail">
                        <div class="tg-sellertitle">
                            <h1>Seller Contact Detail</h1>
                        </div>
                        <div class="tg-sellercontact">
                            <div class="tg-memberinfobox">
                                <div class="tg-memberinfo">
                                    <h3><a href="javascript:void(0);">{{ $ad->user->name }}</a></h3>
                                    <span>Member Since {{ $ad->user->created_at->format('Y-m-d')}}</span>
                                    {{-- <a class="tg-btnseeallads" href="javascript:void(0);">See All Ads</a> --}}
                                </div>
                            </div>
                            @if(Auth::check() && Auth::user()->id != $ad->user_id)
                            <form class="tg-formtheme tg-formdashboard" method="POST" action="{{ route('messages.store', $ad->id) }}">
                                @csrf
                                <fieldset>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tg-lgcolwidthhalf">
                                        <div class="tg-dashboardbox">
                                            <div class="tg-dashboardholder">
                                                <div class="form-group">
                                                    <textarea id="" class="form-control" name="content" placeholder="Make an Offer" autocapitalize="off"></textarea>
                                                </div>
                                                <div style="padding-top: 20px ">
                                                    <button class="tg-btn tg-btnmakeanoffer" type="submit"><i class="icon-briefcase"></i><span>
                                                            <em>Message Seller</em>
                                                            <span>Make an Offer Now</span>
                                                        </span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            @endif

                            @if(Auth::user()->id != $ad->user->id)
                            @php
                                $likedStatus = '';
                                $icon = 'fa fa-heart';
                                $likedText = 'Add To Favourite';
                                if (Auth::user() && Auth::user()->favorites->contains($ad)) {
                                    $likedStatus = 'tg-liked';
                                    $icon = '';
                                    $likedText = 'Unfavorite';
                                }
                            @endphp
                            <span id="add-to-favorites" class="tg-like {{ $likedStatus }}" data-ad-id="{{ $ad->id }}"><i class="{{ $icon }}">{{ $likedText }}</i></span>
                            @endif
                        </div>

                    </div>
                </aside>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
                <div id="tg-content" class="tg-content">
                    <div class="tg-ad tg-verifiedad tg-detail tg-addetail">
                        <div class="tg-adcontent">
                            <ul class="tg-pagesequence">
                                <li><a href="javascript:void(0);">{{ ucwords($ad->subcategory->category->name) }}</a></li>
                                <li><a href="javascript:void(0);">{{ ucwords($ad->subcategory->name) }}</a></li>
                            </ul>
                            <div class="tg-adtitle">
                                <h2>{{ $ad->title }}</h2>
                            </div>
                            <ul class="tg-admetadata">
                                <li>By: <a href="javascript:void(0);">{{ $ad->user->name }}</a></li>
                                {{-- <li>Ad Id: <a href="javascript:void(0);">248GCa57</a></li> --}}
                                <li><i class="icon-earth"></i>
                                    <address>{{ $ad->locations[0]->name ?? 0 }}</address>
                                </li>
                                {{-- <li><i class="icon-eye"></i><span>15642</span></li> --}}
                            </ul>
                            <div class="tg-share">
                                <div class="tg-adadded">
                                    <i class="icon-smartphone"></i>
                                    <span>Added on {{ $ad->created_at->format('Y-m-d') }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- <figure> -->
                        <!-- <span class="tg-themetag tg-featuretag">featured</span> -->
                        <!-- <span class="tg-photocount">See 18 Photos</span> -->
                        <div id="tg-productgaller" class="tg-productgallery">
                            @if(count($ad->images) > 0)
                            @foreach($ad->images as $image)
                            <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset($image->filename) }}" alt="{{ 'image->alt_tex' }}">
                            @endforeach
                            @else
                            <img style="width: 100%; max-height: auto; height: auto; margin-bottom: 20px;" src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="{{ 'image->alt_tex' }}">
                            @endif
                        </div>
                        <!-- </figure> -->
                        <div class="tg-description">
                            <p>{{ $ad->description }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // $(document).ready(function() {
    //     var gallery = new $.ThumbnailGallery($('#tg-productgallery'), {
    //         thumbImages: '../assets/images/thumbnail/img-0',
    //         smallImages: 'img/gallery/small/image',
    //         largeImages:
    //     });
    // });
</script>
<script>
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let addToFavoritesBtn = document.querySelector('#add-to-favorites');
    let adId = addToFavoritesBtn.getAttribute('data-ad-id');
    addToFavoritesBtn.addEventListener('click', () => {
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
                    addToFavoritesBtn.textContent = 'Unfavorite';
                } else {
                    addToFavoritesBtn.classList.remove('tg-liked');
                    addToFavoritesBtn.innerHTML = `<i class="fa fa-heart">Add To Favourite</i>`;
                }
            });
    });
</script>
@endsection
