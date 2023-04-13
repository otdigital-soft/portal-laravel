@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
            <!-- <div class="row"> -->
            <form class="tg-formtheme tg-formdashboard" method="POST" action="{{ route('category.store') }}">
                @csrf
                <fieldset>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tg-lgcolwidthhalf">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Add Category</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                </div>
                                <button class="tg-btn" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!-- </div> -->
            <!-- <div class="row"> -->
            <form class="tg-formtheme tg-formdashboard" method="POST" action="{{ route('subcategory.store') }}">
                @csrf
                <fieldset>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 tg-lgcolwidthhalf">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Add SubCategory</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <div class="form-group">
                                    <div class="tg-select">
                                        <select name="category_id" id="category_id" required>
                                            <option>Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                                </div>
                                <button class="tg-btn" type="submit">Add</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <!-- </div> -->
        </div>
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 tg-lgcolwidthhalf">
            <div class="tg-dashboardbox">
                <div class="tg-dashboardboxtitle">
                    <h2>Category Tree View</h2>
                </div>
                <div class="tg-dashboardholder">
                    <ul>
                        @foreach($categories as $category)
                        <li>{{ ucwords($category->name) }}
                            @if (count($category->subcategories) > 0)
                            <ul>
                                @foreach($category->subcategories as $sub)
                                <li>{{ ucwords($sub->name) }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
</section>
@endsection
