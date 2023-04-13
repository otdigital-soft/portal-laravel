@extends('layouts.main')
@section('styles')
<style>
    figure>img {
        width: 200px;
        height: 200px;
        margin: 10px;
        position: relative;
    }
</style>
@endsection
@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data" class="tg-formtheme tg-formdashboard">
            @csrf
            <fieldset>
                <div class="tg-postanad">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
                        <div class="tg-dashboardbox">
                            <div class="tg-dashboardboxtitle">
                                <h2>Ad Detail</h2>
                            </div>
                            <div class="tg-dashboardholder">
                                <!-- <div class="form-group text-center">
                                    <a href="#" class="tg-btn" data-toggle="modal" data-target=".tg-categorymodal">Select Category Here</a>
                                </div>
                                <div class="form-group">
                                    <ol class="tg-categorysequence">
                                        <li>Electronics</li>
                                        <li>Air Conditioners</li>
                                        <li>Daikin <a href="javascript:void(0);" data-toggle="modal" data-target=".tg-categorymodal">(Change)</a></li>
                                    </ol>
                                </div> -->
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control" placeholder="Enter Ad Title*" required>
                                </div>
                                <div class="form-group tg-priceformgroup">
                                    {{-- <div class="tg-checkbox">
                                        <input id="tg-priceoncall" type="checkbox" name="price" value="on">
                                        <label for="tg-priceoncall">Price On Call</label>
                                    </div> --}}
                                    <input type="number" name="price" class="form-control" placeholder="Price*">
                                </div>
                                <div class="form-group">
                                    <div class="tg-select">
                                        <select name="category_id" id="category-select" required>
                                            <option>Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="tg-select">
                                        <select name="subcategory_id" id="subcategory-select" required>
                                            <option>Select Subcategory</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="tg-select">
                                        <select name="locations" id="location" required>
                                            <option>Select Location</option>
                                            @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea id="" class="form-control" name="description" placeholder="Enter Description"></textarea>
                                </div>
                                <label class="tg-fileuploadlabel" for="tg-photogallery">
                                    <span>Drop files anywhere to upload</span>
                                    <span>Or</span>
                                    <span class="tg-btn">Select Files</span>
                                    <span>Maximum upload file size: 500 KB</span>
                                    <input id="tg-photogallery" class="tg-fileinput" type="file" name="file[]" multiple>
                                </label>
                                <div class="tg-horizontalthemescrollbar tg-profilephotogallery">
                                    <ul id="preview">
                                    </ul>
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" class="tg-btn" style="background-color: #00cc67; border: none" value="Post Ad">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">

                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Get a reference to the category and subcategory select inputs
    const categorySelect = document.getElementById('category-select');
    const subcategorySelect = document.getElementById('subcategory-select');

    // Add an event listener to the category select input
    categorySelect.addEventListener('change', async () => {
        // Get the selected category id
        const categoryId = categorySelect.value;

        // Fetch the subcategories of the selected category using AJAX
        var url = `{{ url('api/subcategories?category_id=${categoryId}') }}`;
        const response = await fetch(url);
        const subcategories = await response.json();

        // Clear the existing options from the subcategory select input
        subcategorySelect.innerHTML = '<option value="" selected disabled>Select Sub Category</option>';

        // Add the fetched subcategories as options to the subcategory select input
        subcategories.forEach(subcategory => {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.text = subcategory.name;
            subcategorySelect.add(option);
        });
    });
</script>

<script>
    $(document).ready(function() {
        var preview = $('#preview');

        // Handle drag and drop events
        preview.on('dragenter', function(e) {
            e.preventDefault();
            $(this).addClass('dragover');
        });

        preview.on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
        });

        preview.on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');

            var files = e.originalEvent.dataTransfer.files;

            // Preview images
            $.each(files, function(i, file) {
                if (file.type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = $('<img>').attr('src', e.target.result);
                        var figure = $('<figure>').append(image);
                        var li = $('<li>').append(figure);
                        preview.append(li);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Handle file input change event
        $('#tg-photogallery').on('change', function() {
            var files = $(this)[0].files;

            // Preview images
            $.each(files, function(i, file) {
                if (file.type.match('image.*')) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = $('<img>').attr('src', e.target.result);
                        var icon = $('<i>').attr('class', 'icon-trash');
                        var figure = $('<figure>').append(image);
                        figure.append(icon);
                        var li = $('<li>').append(figure);
                        preview.append(li);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Handle click event on delete icon
        preview.on('click', 'li i.icon-trash', function() {
            $(this).parent().remove();
        });
    });
</script>
@endsection
