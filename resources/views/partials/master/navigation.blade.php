<div class="tg-navigationarea">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <strong class="tg-logo"><a href="{{ route('home') }}"><img src="https://res.cloudinary.com/dxkd6xlpq/image/upload/c_scale,q_auto:best,w_200/v1677214607/logos/logo%20text/Black_Shifft_Text_Cropped.png" alt="SHIFFT Logo"></a></strong>
                <a class="tg-btn mr-2" href="{{ route('ads.create') }}">
                    <i class="icon-bookmark"></i>
                    <span>post an ad</span>
                </a>
                <a class="tg-btn mr-2" href="{{ route('user.ads') }}">
                    <!-- <i class="icon-bookmark"></i> -->
                    <span>My Ads</span>
                </a>
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
