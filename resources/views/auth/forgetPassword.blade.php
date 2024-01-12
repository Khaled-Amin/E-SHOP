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
                        <p>Forgot your password? No problem. Just let us know your email address and we will email you a
                            password reset link that will allow you to choose a new one.</p>
                        <div class="container">
                            @if ($message = Session::get('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                                    <strong style="color:#000;">{{ $message }}</strong>
                                </div>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('password.email') }}" class="fomr-sign" id="appointment-form">
                            @csrf
                            <div class="col mb-4">
                                <label class="mb-2" for="typeEmailX-2">Email</label>
                                <input type="email" value="" id="typeEmailX-2 " name="email"
                                    class="form-control ">
                            </div>
                            <button class="theme-btn primary-btn btn-sign w-100 mt-4" type="submit">EMAIL PASSWORD RESET
                                LINK</button>
                        </form>
                    </div>

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
        justify-content: center;
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
