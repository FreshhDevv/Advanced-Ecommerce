@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top  mt-5 mb-5" style="border-radius: 50%" src="{{ (!empty($editData->profile_photo_path))?
                            url('upload/admin_images/'.$editData->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>
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
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong> Update Your Profile</h3>

                    <div class="card-body">
                        <form method="post" , action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Name <span> </span></label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span></span></label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email}} ">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Phone<span></span></label>
                                <input type="text" id="email" name="email" class="form-control" value="{{ $user->phone }} ">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">User Image<span></span></label>
                                <input type="file" id="email" name="profile_photo_path" class="form-control">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div> <!-- End col-md-2 -->


        </div> <!-- End row -->
    </div>
</div>

@endsection