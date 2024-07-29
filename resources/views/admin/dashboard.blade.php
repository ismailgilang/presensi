@extends('layouts.admin')
@section('title2', 'Dashboard')
@section('css')
<style>
    body {
        background-color: #f8f9fa;
    }

    .welcome-section {
        margin-top: 50px;
    }

    .welcome-card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-top: -75px;
    }

    .welcome-text {
        margin-top: 15px;
    }
</style>
@endsection
@section('content')
<div class="container welcome-section">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card welcome-card text-center">
                <div class="card-body">
                    <img src="{{asset('foto/logo.png')}}" alt="Profile Picture" class="profile-picture">
                    <h2 class="welcome-text"><span id="typed-welcome"></span></h2>
                    <p class="lead">Senang melihat Anda kembali! Kami berharap Anda memiliki hari yang luar biasa.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Typed('#typed-welcome', {
            strings: ["Selamat Datang, {{$user->name}}"],
            typeSpeed: 50,
            backSpeed: 25,
            startDelay: 500,
            backDelay: 2000,
            loop: true
        });
    });
</script>
@endsection