<div id="tg-sidebarwrapper" class="tg-sidebarwrapper">
    <span id="tg-btnmenutoggle" class="tg-btnmenutoggle">
        <i class="fa fa-angle-left"></i>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="67" viewBox="0 0 20 67">
            <metadata>
                <?xpacket begin="﻿" id="W5M0MpCehiHzreSzNTczkc9d"?>
                <xmpmeta xmlns:x="adobe:ns:meta/" x:xmptk="Adobe XMP Core 5.6-c138 79.159824, 2016/09/14-01:09:01">
                    <rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
                        <rdf:Description rdf:about="" />
                    </rdf:RDF>
                </xmpmeta>
                <?xpacket end="w"?>
            </metadata>
            <path id="bg" class="cls-1"
                d="M20,27.652V39.4C20,52.007,0,54.728,0,67.265,0,106.515.026-39.528,0-.216-0.008,12.32,20,15.042,20,27.652Z" />
        </svg>
    </span>
    <div id="tg-verticalscrollbar" class="tg-verticalscrollbar">
        <strong class="tg-logo"><a href="javascript:void(0);"><img
                    src="{{ asset('https://res.cloudinary.com/dxkd6xlpq/image/upload/c_scale,q_auto:best,w_200/v1677216858/logos/logo%20text/WHITE%20TEXT%20CROPPED.png') }}"
                    alt="image description"></a></strong>
        <div class="tg-user">
            <figure>
                @if(Auth::user()->image_path != null)
                <a href="javascript:void(0);" style="width: 60px; height: 60px;"><img
                        src="{{ asset(Auth::user()->image_path) }}" alt="image description"></a>
                @else
                <a href="javascript:void(0);"><img src="{{ asset('assets/images/author/img-07.jpg') }}"
                        alt="image description"></a>
                @endif
            </figure>
            <div class="tg-usercontent">
                <h3>Hi! {{ Auth::user()->name }}</h3>
                <h4>{{ Auth::user()->type == 'admin' || optional(auth()->user()->role)->name == 'admin' ?
                    'Administrator' : optional(auth()->user()->role)->name ?? '' }}</h4>
            </div>
            <a class="tg-btnedit" href="{{ route('user.profile') }}"><i class="icon-pencil"></i></a>
        </div>
        <nav id="tg-navdashboard" class="tg-navdashboard">
            <ul>
                {{-- <li class="tg-active">
                    <a href="dashboard.html">
                        <i class="icon-chart-bars"></i>
                        <span> Insights</span>
                    </a>
                </li> --}}
                @if(auth()->user()->type == 'admin' || optional(auth()->user()->role)->name == 'admin')
                <li
                    class="menu-item-has-children {{ request()->routeIs('users.index') || request()->routeIs('category.create') || request()->routeIs('location.index') || request()->routeIs('role.index') ? 'nav--active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="icon-envelope"></i>
                        <span>Management</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ request()->routeIs('category.create') ? 'inner-nav--active' : '' }}">
                            <a href="{{ route('category.create') }}">
                                <i class="icon-eye"></i>
                                <span>Category</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('location.index') ? 'inner-nav--active' : '' }}">
                            <a href="{{ route('location.index') }}">
                                <i class="icon-location"></i>
                                <span>Location</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('role.index') ? 'inner-nav--active' : '' }}">
                            <a href="{{ route('role.index') }}">
                                <i class="icon-chart-bars"></i>
                                <span>Role</span>
                            </a>
                        </li>
                        <li
                            class="menu-item-has-children {{ request()->routeIs('users.index') ? 'inner-nav--active' : '' }} tg-open">
                            <a href="javascript:void(0);">
                                <i class="icon-envelope"></i>
                                <span>Users</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('users.index') }}">All Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'verified']) }}">Verified Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'pending']) }}">Pending Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'admin']) }}">Admin</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('projects.index') }}"
                        class="{{ request()->routeIs('projects.index') ? 'nav--active' : '' }}">
                        <i class="icon-chart-bars"></i>
                        <span>Projects</span>
                    </a>
                </li>
                @endif

                @if(optional(auth()->user()->role)->name == 'management')
                <li
                    class="menu-item-has-children {{ request()->routeIs('users.index') || request()->routeIs('category.create') || request()->routeIs('location.index') || request()->routeIs('role.index') ? 'nav--active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="icon-envelope"></i>
                        <span>Management</span>
                    </a>
                    <ul class="sub-menu">
                        <li
                            class="menu-item-has-children {{ request()->routeIs('users.index') ? 'inner-nav--active' : '' }} tg-open">
                            <a href="javascript:void(0);">
                                <i class="icon-envelope"></i>
                                <span>Users</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('users.index') }}">All Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'verified']) }}">Verified Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'pending']) }}">Pending Users</a></li>
                                <li><a href="{{ route('users.index', ['type' => 'admin']) }}">Admin</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('projects.index') }}"
                        class="{{ request()->routeIs('projects.index') ? 'nav--active' : '' }}">
                        <i class="icon-chart-bars"></i>
                        <span>Projects</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->type != 'admin' && optional(auth()->user()->role)->name != 'admin' && optional(auth()->user()->role)->name != 'management')
                <li>
                    <a href="{{ route('users.projects.index') }}"
                        class="{{ request()->routeIs('projects.index') ? 'nav--active' : '' }}">
                        <i class="icon-chart-bars"></i>
                        <span>Projects</span>
                    </a>
                </li>
                @endif

                <li
                    class="menu-item-has-children {{ request()->routeIs('user.ads') || request()->routeIs('ads.favorites') ? 'nav--active' : '' }}">
                    <a href="javascript:void(0);">
                        <i class="icon-layers"></i>
                        <span>Ads</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{ request()->routeIs('user.ads') ? 'inner-nav--active' : '' }}">
                            <a href="{{ route('user.ads') }}">
                                <i class="icon-layers"></i>
                                <span>My Ads</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('ads.favorites') ? 'nav--active' : '' }}">
                            <a href="{{ route('ads.favorites') }}">
                                <i class="icon-heart"></i>
                                <span>My Favourites Ads</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="{{ route('ads.conversations') }}"
                        class="{{ request()->routeIs('ads.conversations') ? 'nav--active' : '' }}">
                        <i class="icon-envelope"></i>
                        <span>Offers/Messages</span>
                        @if ($unreadCount ?? '' > 0)
                        <span class="badge badge-pill badge-danger">{{ $unreadCount ?? '' }}</span>
                        @endif
                    </a>
                </li>
                {{-- <li class="menu-item-has-children">
                    <a href="javascript:void(0);">
                        <i class="icon-envelope"></i>
                        <span>Offers/Messages</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('users.index', ['type' => 'verified']) }}">All Ads</a></li>
                        <li><a href="{{ route('users.index', ['type' => 'pending']) }}">Featured Ads</a></li>
                        <li><a href="dashboard-myads.html">Active Ads</a></li>
                        <li><a href="dashboard-myads.html">Inactive Ads</a></li>
                        <li><a href="dashboard-myads.html">Sold Ads</a></li>
                        <li><a href="dashboard-myads.html">Expired Ads</a></li>
                        <li><a href="dashboard-myads.html">Deleted Ads</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="dashboard-payments.html">
                        <i class="icon-cart"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li>
                    <a href="dashboard-privacy-setting.html">
                        <i class="icon-star"></i>
                        <span>Privacy Settings</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('user.profile') }}"
                        class="{{ request()->routeIs('user.profile') ? 'nav--active' : '' }}">
                        <i class="icon-cog"></i>
                        <span>Profile Settings</span>
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
        </nav>
        {{-- <div class="tg-socialandappicons">
            <ul class="tg-socialicons">
                <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
                </li>
                <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a>
                </li>
                <li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                <li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
            </ul>
            <ul class="tg-appstoreicons">
                <li><a href="javascript:void"><img src="images/icons/app-01.png" alt="image description"></a></li>
                <li><a href="javascript:void"><img src="images/icons/app-02.png" alt="image description"></a></li>
            </ul>
        </div> --}}
    </div>
</div>
