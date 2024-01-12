@extends('layouts.front')

@section('title')
    @isset($Settings->nameWebsite)
        {{ $Settings->nameWebsite }}
    @endisset
@endsection


@section('content')
    <section class="section">
        <div class="container">
            <div class="box-main-foo">
                <div class="sign-in">
                    <div class="part-above">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li class="text-danger">
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <h4>Welcome to CountryBoot</h4>
                        <form method="POST" action="{{ route('register') }}" class="fomr-sign" id="appointment-form">
                            @csrf
                            <div class="col mb-4">
                                <label class="mb-2" for="typeNameX-2">Name</label>
                                <input type="text" value="" id="typeNameX-2 " name="name" class="form-control ">
                            </div>
                            <div class="col mb-4">
                                <label class="mb-2" for="typeEmailX-2">Email</label>
                                <input type="email" value="" id="typeEmailX-2 " name="email"
                                    class="form-control ">
                            </div>
                            <div class="col mb-4">
                                <label class="mb-2" for="typePasswordX-2">Password</label>
                                <input type="password" name="password" id="typePasswordX-2" class="form-control  ">
                            </div>
                            <div class="col-12 mb-4">
                                <label for="" class="mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                            <!-- Checkbox -->
                            <button class="theme-btn primary-btn btn-sign w-100 mt-4" type="submit">Sign in</button>
                        </form>
                        <div class="sec">
                            <p>
                                Already registered?
                                <a href="{{ route('login') }}">Sign in</a>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="left-form-login">
                    <img src="{{ asset('uploads/login.svg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .section {
        margin-top: 3rem;
        margin-bottom: 3rem;
    }

    .box-main-foo {
        display: flex;
        justify-content: space-between;
    }

    .sign-in {
        width: 50%;
        background-color: #fff;
        padding: 2rem;
        margin-bottom: 2rem;
        margin-bottom: 0rem !important;
    }

    .left-form-login {
        width: 50%;
        height: auto;
        background-color: #fff;
        padding-top: 5rem;
        text-align: center;
    }

    .left-form-login img {
        height: 75%;
    }

    .part-above h4 {
        font-size: 22px;
        color: #262626;
        margin-bottom: 10px;
        text-align: center;
    }

    .fomr-sign {
        color: #707070;
    }

    .btn-sign {
        padding: 8px;
        font-size: 15px !important;
        border: none;
        border-radius: 5px;
        color: #fff;
        background-color: #343a40;
    }

    .sec p {
        color: #707070;
    }

    .sec a {
        color: #343a40;
    }
</style>
