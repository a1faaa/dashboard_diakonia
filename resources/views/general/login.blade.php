@extends('layout.general')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-group d-block d-md-flex row">
                    <div class="card col-md-12 p-4 mb-0">
                        <div class="card-body">
                            <!-- LOGO -->
                            <div class="logo text-center mb-4">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                                style="width: 180px; height: auto; display:inline-block;"> <!-- Ganti 'logo.png' dengan path logo Anda -->
                            </div>
                            <form class="auth-form login-form" method="POST" action="{{ route('general.aksi.login') }}">
                                @csrf
                                @if (session('flash'))
                                    {!! session('flash')['message'] !!}
                                @endif

                               <center> 
                                <h1>Diakonia Efrata Wosi</h1>
                                <p class="text-body-secondary">Selamat Datang, Silahkan Masukkan Username dan Password Anda</p>
                               </center>
                                <div class="input-group mb-3"><span class="input-group-text">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="var(--ci-primary-color, currentColor)" d="M411.6,343.656l-72.823-47.334,27.455-50.334A80.23,80.23,0,0,0,376,207.681V128a112,112,0,0,0-224,0v79.681a80.236,80.236,0,0,0,9.768,38.308l27.455,50.333L116.4,343.656A79.725,79.725,0,0,0,80,410.732V496H448V410.732A79.727,79.727,0,0,0,411.6,343.656ZM416,464H112V410.732a47.836,47.836,0,0,1,21.841-40.246l97.66-63.479-41.64-76.341A48.146,48.146,0,0,1,184,207.681V128a80,80,0,0,1,160,0v79.681a48.146,48.146,0,0,1-5.861,22.985L296.5,307.007l97.662,63.479h0A47.836,47.836,0,0,1,416,410.732Z" class="ci-primary"/>
                                      </svg>
                                </span>
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="var(--ci-primary-color, currentColor)" d="M384,200V144a128,128,0,0,0-256,0v56H88V328c0,92.635,75.364,168,168,168s168-75.365,168-168V200ZM160,144a96,96,0,0,1,192,0v56H160ZM392,328c0,74.99-61.01,136-136,136s-136-61.01-136-136V232H392Z" class="ci-primary"/>
                                      </svg>        
                                </span>
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary px-4 float-end" type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
