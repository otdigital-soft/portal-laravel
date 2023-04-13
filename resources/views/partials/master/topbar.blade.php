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
