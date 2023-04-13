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
