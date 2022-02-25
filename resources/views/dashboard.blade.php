@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top  mt-5 mb-5" style="border-radius: 50%" src="{{ (!empty($user->profile_photo_path))?
                            url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>
                            <ul class="list-group list-group-flash">
                                <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                                <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                                <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                                <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                            </ul>
            </div> <!-- End col-md-2 -->

            <div class="col-md-2">

            </div> <!-- End col-md-2 -->

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong> Welcome To FreshDev Online Shop</h3>
                </div>

            </div> <!-- End col-md-2 -->


        </div> <!-- End row -->
    </div>
</div>

@endsection