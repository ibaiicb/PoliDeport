@extends('layouts.welcome')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('My Data') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="flex my-data-container">
                                <div class="avatar-file-container">
                                    <label class="avatar-label">
                                        @if(isset(Auth::user()->getMedia('avatars')[0]))
                                            <img src="{{ Auth::user()->getMedia('avatars')->last()->getUrl() }}" id="user-img" alt="{{ __('user_image') }}">
                                        @else
                                            <img src="{{ asset('images/user.png') }}" alt="{{ __('user_image') }}" id="user-img"/>
                                        @endif
                                        <input type="file" name="avatar" class="input-avatar" id="input-avatar">
                                    </label>
                                </div>
                                <div class="data-container">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="name">
                                        <label for="name">{{__('Name')}}</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="email">
                                        <label for="email">{{__('Email')}}</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}" placeholder="user name">
                                        <label for="name">{{__('Username')}}</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" placeholder="address">
                                        <label for="address">{{__('Address')}}</label>
                                    </div>
                                    <a class="btn btn-link change-password-link" href="{{ route('password.request') }}">
                                        {{ __('Change your password') }}
                                    </a>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save') }}
                                        </button>
                                        <a class="btn btn-secondary btn-cancel" href="{{ route('home') }}">
                                            {{ __('Cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('input-avatar').addEventListener('change', changeImg);

        function changeImg() {
            let img = document.getElementById('input-avatar').files[0];

            document.getElementById('user-img').src = URL.createObjectURL(img);
        }
    </script>
@endpush
