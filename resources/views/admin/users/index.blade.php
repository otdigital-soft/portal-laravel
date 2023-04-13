@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form class="tg-formtheme tg-formdashboard">
            <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2> {{ $type == null ? 'All' : ucwords($type) }} Users</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <nav class="tg-navtabledata">
                                <ul>
                                    <!-- <li class="tg-active"><a href="{{ route('users.index') }}">All Users ({{ count($users)}})</a></li>
                                    <li><a href="">Verified Users (12)</a></li>
                                    <li><a href="javascript:void(0);" data-category="active">Active (42)</a></li>
                                    <li><a href="javascript:void(0);" data-category="inactive">Inactive (03)</a></li>
                                    <li><a href="javascript:void(0);" data-category="sold">Sold (02)</a></li>
                                    <li><a href="javascript:void(0);" data-category="expired">Expired (01)</a></li>
                                    <li><a href="javascript:void(0);" data-category="deleted">Deleted (03)</a></li> -->
                                </ul>
                            </nav>
                            <div class="tg-otherfilters">
                                <div class="row">
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
                                                #
                                                <label for="tg-checkedall"></label>
                                            </span>
                                        </th>
                                        <!-- <th>Photo</th> -->
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr data-category="active">
                                        <td data-title="">
                                            <span class="tg-checkbox">
                                                <span>{{ $loop->iteration }}</span>
                                                <label for="tg-adone"></label>
                                            </span>
                                        </td>
                                        {{-- <td data-title="Photo">
                                            @if (count($ad->images) > 0)
                                            <img src="{{ asset($ad->images[0]->filename) }}" alt="image description" onerror="this.style.display='none'" width="150">
                                        @else
                                        {{ 'No image'}}
                                        @endif
                                        </td> --}}
                                        <td data-title="Full Name">
                                            <h3>{{ $user->name }}</h3>
                                            <span>Joined: {{ $user->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td data-title="Email"><span class="tg-adcategories">{{
                                                $user->email ?? ''}}</span>
                                        </td>
                                        @php
                                        $status = '';
                                        if ($user->status == 'verified') {
                                            $status = 'success';
                                        }else {
                                            $status = 'warning';
                                        }
                                        @endphp
                                        <td data-title="Ad Status"><span class="tg-adstatus tg-adstatusactive bg-label-{{$status}}">{{ $user->status == 'verified' ? 'active' : 'pending' }}</span></td>
                                        <td data-title="Full Name">
                                            <h3>{{ $user->role->name ?? $user->type }}</h3>
                                        </td>
                                        <td data-title="Action">
                                            <div class="tg-btnsactions">
                                                <a class="tg-btnaction tg-btnactionview" href="{{ route('users.show', $user->id) }}"><i class="fa fa-eye"></i></a>
                                                <a class="tg-btnaction tg-btnactiondelete" href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-user-{{ $user->id }}').submit(); }"><i class="fa fa-trash"></i></a>
                                                <form id="delete-user-{{ $user->id }}" action="{{ route('users.delete', $user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{ 'No users yet'}}
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- <nav class="tg-pagination"> -->
                            {{ $users->links('vendor.pagination.custom') }}
                            <!-- </nav> -->
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

    function openEditModal(ad) {
        console.log(ad);
        // set the value of the ad ID input field in the modal
        $('#modal-edit-ad').find('input[name="ad_id"]').val(ad.id);
        $('#modal-edit-ad').find('input[name="title"]').val(ad.title);
        $('#modal-edit-ad').find('input[name="price"]').val(ad.price);
        $('#modal-edit-ad').find('textarea[name="description"]').val(ad.description);
        var path = ad.images.length > 0 ? ad.images[0].filename : '';
        var imageUrl = `{{ url('${path}') }}`
        $('#modal-edit-ad #ad-image-preview').attr('src', imageUrl);

        // open the modal
        $('#modal-edit-ad').modal('show');
    }
</script>

@endsection
