@extends('layouts.login_app')
@section('content')

@if(Session::has('serverError'))
{{Session::get('serverError')}}
@endif
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);"><b>ONLINE TICKET SYSTEM LOGIN</b></a>

    </div>
    <div class="card">
        <div class="body">

            <form id="sign_in" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                <div class="msg"></div>
                <div class="input-group">
                        <span class="input-group-addon">

                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">

                        <input id="email" placeholder="Email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                       <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="input-group custom_login_button">
                    <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                </div>
                <div class="row">

                </div>
                <div class="row m-t-15 m-b--20">

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
