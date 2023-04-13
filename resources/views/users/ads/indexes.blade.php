@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form class="tg-formtheme tg-formdashboard">
            <fieldset>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>My Adverts</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <nav class="tg-navtabledata">
                                <ul>
                                    <li class="tg-active"><a href="_.html">All Ads ({{ count($ads)}})</a></li>
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
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <!-- <th>Featured</th> -->
                                        <th>Ad Status</th>
                                        <th>Price &amp; Location</th>
                                        <th>Date</th>
                                        <th>Views</th>
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
                                            <img src="{{ asset($ad->images[0]->filename) }}" alt="image description" onerror="this.style.display='none'" width="150">
                                            @else
                                            <!-- <img src="{{ asset('assets/images/ads/img-01.jpg') }}" alt="No image" width="150"> -->
                                            {{ 'No image'}}
                                            @endif
                                        </td>
                                        <td data-title="Title">
                                            <h3>{{ $ad->title }}</h3>
                                            {{-- <span>Ad ID: ng3D5hAMHPajQrM</span> --}}
                                        </td>
                                        <td data-title="Category"><span class="tg-adcategories">{{
                                                $ad->subcategory->name ?? ''}}</span>
                                        </td>
                                        {{-- <td data-title="Featured">Yes</td> --}}
                                        <td data-title="Ad Status"><span class="tg-adstatus tg-adstatusactive">active</span></td>
                                        <td data-title="Price &amp; Location">
                                            <h3>${{ $ad->price }}</h3>
                                            @foreach($ad->locations as $location)
                                            <address>{{ $location->name ?? ''}}
                                            </address>
                                            @endforeach

                                        </td>
                                        <td data-title="Date">
                                            <time datetime="2017-08-08">{{ $ad->created_at->diffForHumans() }}</time>
                                            <span>Published</span>
                                        </td>
                                        <td data-title="Views">{{ $ad->views }}</td>
                                        <td data-title="Action">
                                            <div class="tg-btnsactions">
                                                {{-- <a class="tg-btnaction tg-btnactionview"
                                                    href="javascript:void(0);"><i class="fa fa-eye"></i></a> --}}
                                                <!-- <a class="tg-btnaction tg-btnactionedit" href="javascript:void(0);" data-toggle="modal" data-target="#modal-edit-ad"><i class="fa fa-pencil"></i></a> -->
                                                <a class="tg-btnaction tg-btnactionedit" href="javascript:void(0);" onclick="openEditModal({{ json_encode($ad) }})"><i class="fa fa-pencil-square-o"></i></a>
                                                <a class="tg-btnaction tg-btnactiondelete" href="{{ route('user.ad.delete', $ad->id) }}" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this ad?')) { document.getElementById('delete-ad-{{ $ad->id }}').submit(); }"><i class="fa fa-trash"></i></a>
                                                <form id="delete-ad-{{ $ad->id }}" action="{{ route('user.ad.delete', $ad->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{ 'You don\'t have any Ad yet'}}
                                    @endforelse
                                </tbody>
                            </table>
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
