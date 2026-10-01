@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <x-input-image name="avatar" :image="auth('admin')->user()->avatar" />
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col md-9">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="">Name</label>
                                    <input type="text" class="form-control" name="name" id=""
                                        value="{{ auth('admin')->user()->name }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required" for="">Email</label>
                                    <input type="email" class="form-control" name="email" id=""
                                        value="{{ auth('admin')->user()->email }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Account</button>
                </form>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.Password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-30">
                        <div class="mb-3">
                            <label class="form-label required" for="">Current password</label>
                            <input type="password" class="form-control" name="current_password" id="">
                            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="">Password</label>
                            <input type="password" class="form-control" name="password" id="">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="">Confirm password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="submit"
                                value="Submit">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
