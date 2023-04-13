@extends('layouts.main')

@section('content')
@php
$userRole = $user->role->name ?? '';
$userRoles = [];
if (auth()->user()->type != 'admin') {
    foreach($roles as $role) {
        if ($role->name != 'admin') {
            $userRoles[] = $role;
        }
    }
} else {
    $userRoles = $roles;
}
@endphp
<section class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <fieldset>
            <a href="{{ url()->previous() }}"><button class="tg-btn" style="margin: 10px;"><i class="icon-arrow-left"></i> Back</button></a>
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
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name*" value="{{ $user->first_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name*" value="{{ $user->last_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" readonly placeholder="Email*" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="email" id="role" name="email" class="form-control" readonly placeholder="Email*" value="{{ $userRole == '' ? $user->type : $userRole }}" readonly>
                            </div>
                            <!-- <div class="form-group">
                                <input type="file" name="image" class="form-control" placeholder="Phone Number*">
                            </div> -->
                            <!-- <button class="tg-btn" type="submit">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tg-lgcolwidthhalf">
                <form action="{{ route('users.update') }}" method="POST" class="tg-formtheme tg-formdashboard">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="tg-dashboardbox">
                        <div class="tg-dashboardboxtitle">
                            <h2>Change Role</h2>
                        </div>
                        <div class="tg-dashboardholder">
                            <div class="form-group">
                                <label for="tg-checkedall">Current Role: {{ $userRole == '' ? $user->type : $userRole }}</label>
                            </div>
                            <div class="form-group">
                                <div class="tg-select">
                                    <select name="role_id" id="category-select" required>
                                        <option>Select New Role</option>
                                        @foreach ($userRoles as $role)
                                        <option value="{{ $role->id }}" {{ $userRole == $role->name ? 'disabled' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <button class="tg-btn" type="submit">Change Now</button> -->
                            <input class="tg-btn" type="submit" style="background-color: #00cc67; border: none;" value="Change Now" 
                                {{ (auth()->user()->type != 'admin' && auth()->user()->role->name != 'admin' && ($user->role->name ?? $user->type) == 'admin') || $user->status == 'pending' ? 'disabled' : '' }}
                            />
                        </div>
                    </div>
                </form>
            </div>

        </fieldset>

    </div>
</section>
@endsection
