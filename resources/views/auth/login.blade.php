@extends('layouts.app')

@section('content')    
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100" style="background-image: url({{ asset('img/bg-login.png') }});">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column justify-content-end" style="margin-left: auto">
                            <div class="card card-plain bg-gray-300">
                                <div class="px-3 pt-3 text-start">
                                    <h4 class="font-weight-bolder">Sign In</h4>
                                    <p class="mb-0">Enter your email and password to sign in</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="email" name="email" class="form-control form-control-lg" value="" aria-label="Email" placeholder="Email" autofocus>
                                            @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" placeholder="password">
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>                                       
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                        </div>

                                        {{-- <a href="{{ route('reset.password') }}" class="text-primary text-gradient font-weight-bold text-xs float-end mt-1">forgot password?</a> --}}
                                        
                                        @if (session('status'))
                                            <p class="text-danger text-xs pt-1">{{ session('status') }}</p>
                                        @endif
                                    </form>
                                </div>                               
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <span class="mask bg-gradient-dark opacity-3"></span>
            </div>
        </section>
    </main>
@endsection
