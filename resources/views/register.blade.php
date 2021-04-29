@extends('layouts.default', ['title' => 'Register'])

@section('content')
    <main class="container mt-3">
        <form id="registerForm" class="form-floating m-3" action="{{ route('user.add') }}" method="POST">
            <h4>Fill in the below form to create a free account</h4>
            @method('POST')
            @csrf

            <div class="row g-2">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="text" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                        <label for="name">Your Name</label>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            name="email" placeholder="Your email" value="{{ old('email') }}" required>
                        <label for="email">Email</label>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="password" id="password_confirmation" class="form-control"
                            name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mx-auto mb-3">
                <button class="btn btn-success" type="submit">
                    Submit<span class="material-icons right-align">keyboard_arrow_right</span>
                </button>
            </div>

            <div class="">
                <p>Already have an account? Click <a class="" href="{{ route('app.login') }}">here</a> to login.</p>
            </div>
        </form>

        @include('includes.err-accordian')
    </main>
@endsection
