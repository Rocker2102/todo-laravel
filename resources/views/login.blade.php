@extends('layouts.default', ['title' => 'Login'])

@section('content')
    <main class="container mt-3">
        <form id="loginForm" class="form-floating m-3" action="{{ route('user.authenticate') }}" method="POST">
            <h4>Enter your credentials below to login</h4>
            @method('POST')
            @csrf

            <div class="row g-2">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="email" id="email" class="form-control" name="email"
                            placeholder="Your email" value="{{ old('email') }}" required>
                        <label for="email">Email</label>
                        <div class="invalid-feedback">
                            Invalid email
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="password" id="password" class="form-control" name="password"
                            placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mx-auto mb-3">
                <button class="btn btn-success" type="submit">
                    Login<span class="material-icons right-align">keyboard_arrow_right</span>
                </button>
            </div>

            <div class="">
                <p>Don't have an account? Click <a class="" href="{{ route('app.register') }}">here</a> to create one in no time.</p>
            </div>
        </form>

        @include('includes.err-accordian')
    </main>
@endsection
