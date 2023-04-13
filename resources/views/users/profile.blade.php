@extends('layouts.main')

@section('content')
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <fieldset>
            <!-- <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>Profile Photo</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <label class="tg-fileuploadlabel" for="tg-photogallery">
                                <span>Drop files anywhere to upload</span>
                                <span>Or</span>
                                <span class="tg-btn">Select Files</span>
                                <span>Maximum upload file size: 500 KB</span>
                                <input id="tg-photogallery" class="tg-fileinput" type="file" name="file">
                            </label>
                            <div class="tg-horizontalthemescrollbar tg-profilephotogallery">
                                <ul id="preview">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="tg-formtheme tg-formdashboard">
                    @csrf
                    @method('PUT')
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>Profile Detail</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <!-- <div class="form-group">
                                <strong>I’m a:</strong>
                                <div class="tg-selectgroup">
                                    <span class="tg-radio">
                                        <input id="tg-mail" type="radio" name="gender" value="mail" checked>
                                        <label for="tg-mail">mail</label>
                                    </span>
                                    <span class="tg-radio">
                                        <input id="tg-femail" type="radio" name="gender" value="femail">
                                        <label for="tg-femail">femail</label>
                                    </span>
                                    <span class="tg-radio">
                                        <input id="tg-company" type="radio" name="gender" value="company">
                                        <label for="tg-company">Company</label>
                                    </span>
                                </div>
                            </div> -->
                            <div class="form-group flex justify-start items-center">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" name="first_name" class="form-control" placeholder="First Name*" value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group flex justify-start items-center">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control" placeholder="Last Name*" value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" readonly placeholder="Email*" value="{{ $user->email }}">
                            </div>
                            <!-- <div class="form-group">
                                <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number*">
                            </div> -->
                            <div class="form-group">
                                <input type="file" name="image" class="form-control" placeholder="Phone Number*">
                            </div>
                            <button class="tg-btn" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
                <form action="{{ route('user.profile.password') }}" method="POST" class="tg-formtheme tg-formdashboard">
                    @csrf
                    @method('PUT')
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>Change Password</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <div class="form-group">
                                <input type="password" name="old_password" class="form-control" placeholder="Current Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                            </div>
                            <button class="tg-btn" type="submit">Change Now</button>
                        </div>
                    </div>
                </form>
            </div>

        </fieldset>

    </div>
</section>
@endsection

@section('scripts')
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
