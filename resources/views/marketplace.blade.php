@extends('layouts.master')

@section('content')
<section class="tg-sectionspace tg-haslayout">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead">
                    <div class="tg-title">
                        <h2>Ads</h2>
                    </div>
                    <div class="tg-description">
                        <p>Over {{ count($ads) }} Ads</p>
                    </div>
                </div>
            </div>
            <div class="tg-ads">
                @foreach($ads as $ad)
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                    <div class="tg-ad tg-verifiedad">
                        <figure>
                            {{-- <span class="tg-themetag tg-featuretag">featured</span> --}}
                            @php
                            $url = url('storage/public/ad_images/iam.png');
                            @endphp
                            @if (count($ad->images) > 0)
                            <a href="javascript:void(0);"><img src="{{ asset($ad->images[0]->filename) }}" alt="{{ $ad->description }}"></a>
                            @else
                            <a href="javascript:void(0);"><img src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="image description"></a>
                            @endif
                            <!-- <span class="tg-photocount">See 18 Photos</span> -->
                        </figure>
                        <div class="tg-adcontent">
                            <ul class="tg-productcagegories">
                                <li><a href="javascript:void(0);">{{ ucwords($ad->subcategory->name) }}</a></li>
                            </ul>
                            <div class="tg-adtitle">
                                <h3><a href="javascript:void(0);">{{ $ad->title }}</a></h3>
                            </div>
                            <time datetime="2017-06-06">Last Updated: {{ $ad->created_at->diffForHumans() }}</time>
                            <div class="tg-adprice">
                                <h4>${{ $ad->price }}</h4>
                            </div>
                            <address>{{ $ad->locations[0]->name ?? ''}}</address>
                            <div class="tg-phonelike">
                                <a class="tg-btnphone" href="{{ route('ads.show', $ad->id) }}">
                                    <i class="icon-eye"></i>
                                    <span data-toggle="tooltip" data-placement="top" title="Show Phone No." data-last="0800 - 1234 - 562 - 6"><em>View</em></span>
                                </a>
                                <span class="tg-like {{ Auth::user() && Auth::user()->favorites->contains($ad) ? 'tg-liked' : '' }} add-to-favorites" data-ad-id="{{ $ad->id }}"><i class="fa fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($ads) > 10)
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-btnbox">
                    <a class="tg-btn" href="{{ route('ads') }}">View All</a>
                </div>
            </div>
            @endif
        </div>
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
</script>
@endsection
