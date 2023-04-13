@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
            <form class="tg-formtheme tg-formdashboard" method="POST" action="{{ route('location.store') }}">
                @csrf
                <fieldset>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tg-lgcolwidthhalf">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Add Location</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                </div>
                                <!-- <div class="form-group">
                                    <textarea id="" class="form-control" name="description" placeholder="Enter Description"></textarea>
                                </div> -->
                                <button class="tg-btn" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 tg-lgcolwidthhalf">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Location List</h2>
                </div>
                <div class="tg-dashboardholder">
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
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($locations as $location)
                            <tr data-category="active">
                                <td data-title="">
                                    <span class="tg-checkbox">
                                        <!-- <input id="tg-adone" type="checkbox" name="myads" value="myadone"> -->
                                        <span>{{ $loop->iteration }}</span>
                                        <label for="tg-adone"></label>
                                    </span>
                                </td>
                                <td data-title="Name">
                                    <h3>{{ $location->name }}</h3>
                                </td>
                                <td data-title="Action">
                                    <div class="tg-btnsactions">
                                        {{-- <a class="tg-btnaction tg-btnactionview"
                                                    href="javascript:void(0);"><i class="fa fa-eye"></i></a> --}}
                                        {{-- <a class="tg-btnaction tg-btnactionedit"
                                                    href="javascript:void(0);"><i class="fa fa-pencil"></i></a> --}}
                                        <a class="tg-btnaction tg-btnactiondelete" href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this location?')) { document.getElementById('delete-location-{{ $location->id }}').submit(); }"><i class="fa fa-trash"></i></a>
                                        <form id="delete-location-{{ $location->id }}" action="{{ route('location.delete', $location->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{ 'No location'}}
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="tg-pagination">
                        {{ $locations->links() }}
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
</section>
@endsection
