@extends('layouts.default', ['title' => 'Profile'])

@section('content')
    <main class="container mt-3">
        @include('includes.err-accordian', ['forms' => [
            'updateAcc', 'changePwd', 'deleteAcc'
        ]])

        <form id="updateForm" class="form-floating m-3" action="{{ route('user.update') }}" method="POST">
            <h4>Welcome, {{ Auth::user()->name }}</h4>
            @method('POST')
            @csrf

            <div class="row g-2">
                <div class="col-md-2 col-sm-4 mb-3">
                    <div class="form-floating">
                        <input type="number" id="uid" class="form-control is-valid"
                            placeholder="Identifier" value="{{ Auth::id() }}" readonly>
                        <label for="uid">Identifier</label>
                    </div>
                </div>
                <div class="col-md-4 col-sm-8 mb-3">
                    <div class="form-floating">
                        <input type="text" id="name"
                            class="form-control {{ $errors->updateAcc->has('name') ? 'is-invalid' : '' }}"
                            name="name" placeholder="Name" value="{{ old('name') ?? Auth::user()->name }}" disabled required>
                        <label for="name">Name</label>
                        @if ($errors->updateAcc->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->updateAcc->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="email" id="email"
                            class="form-control {{ $errors->updateAcc->has('email') ? 'is-invalid' : '' }}"
                            name="email" placeholder="Email" value="{{ old('email') ?? Auth::user()->email }}" disabled required>
                        <label for="email">Email</label>
                        @if ($errors->updateAcc->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->updateAcc->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="text" id="email_verified_at"
                            class="form-control {{ Auth::user()->email_verified_at ? 'is-valid' : 'is-invalid' }}"
                            placeholder="Email verified at"
                            value="{{ Auth::user()->email_verified_at ?? '-' }}" readonly>
                        <label for="email_verified_at">Email verified at</label>
                        <div class="invalid-feedback">
                            Verification disbabled by server
                        </div>
                        <div class="valid-feedback">
                            Email verified
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="text" id="last_updated" class="form-control"
                            placeholder="Last Updated" value="{{ Auth::user()->updated_at }}" readonly>
                        <label for="last_updated">Last Updated</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="text" id="created_on" class="form-control"
                            placeholder="Created on" value="{{ Auth::user()->created_at }}" readonly>
                        <label for="created_on">Created on</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 d-grid gap-1 mx-auto mb-3">
                    <button class="btn btn-primary" type="button" data-action="edit">
                        Toggle Edit<span class="material-icons right-align">edit</span>
                    </button>
                </div>
                <div class="col-sm-8 d-grid gap-1 mx-auto mb-3">
                    <button class="btn btn-success" type="submit" disabled>
                        Update<span class="material-icons right-align">update</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="my-2 mx-3">
            <hr/>
        </div>

        <form id="changePasswordForm" class="form-floating m-3" action="{{ route('user.change_pwd') }}" method="POST">
            <h4>Change Password</h4>
            @method('POST')
            @csrf

            <div class="row g-2">
                <div class="col-sm-12">
                    <div class="form-floating mb-3">
                        <input type="password" id="password"
                            class="form-control {{ $errors->changePwd->has('password') ? 'is-invalid' : '' }}"
                            name="password" placeholder="Current Password" required>
                        <label for="name">Current Password</label>
                        @if ($errors->changePwd->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->changePwd->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="form-floating">
                        <input type="password" id="new_password"
                            class="form-control {{ $errors->changePwd->has('new_password') ? 'is-invalid' : '' }}"
                            name="new_password" placeholder="New Password" required>
                        <label for="name">New Password</label>
                        @if ($errors->changePwd->has('new_password'))
                            <div class="invalid-feedback">
                                {{ $errors->changePwd->first('new_password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="form-floating">
                        <input type="password" id="new_password_confirmation" class="form-control"
                            name="new_password_confirmation" placeholder="Confirm Password" required>
                        <label for="name">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="d-grid gap-2 mx-auto mb-3">
                    <button class="btn btn-success" type="submit">
                        Confirm Change<span class="material-icons right-align">keyboard_arrow_right</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="my-2 mx-3">
            <hr />
        </div>

        <div class="m-3">
            <div class="accordion" id="accDeleteAccordian">
                <div class="accordion-item border border-danger rounded">
                    <h2 class="accordion-header" id="accDeleteHeading">
                        <button class="accordion-button alert-danger collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accDeleteCollapse"
                            aria-expanded="true" aria-controls="accDeleteCollapse">
                            Danger Zone
                        </button>
                    </h2>
                    <div id="accDeleteCollapse" class="accordion-collapse collapse" aria-labelledby="accDeleteHeading"
                        data-bs-parent="#accDeleteAccordian">
                        <div class="accordion-body">
                            <form id="deleteAccountForm" class="form-floating m-3" action="{{ route('user.delete') }}" method="POST">
                                <h4 class="text-danger">Delete account? This can't be undone!</h4>
                                @method('DELETE')
                                @csrf

                                <div class="row g-2">
                                    <div class="col-sm-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" id="delete_password"
                                                class="form-control {{ $errors->deleteAcc->has('password') ? 'is-invalid' : '' }}"
                                                name="password" placeholder="Password" required>
                                            <label for="delete_password">Password</label>
                                            @if ($errors->deleteAcc->has('password'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->deleteAcc->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="d-grid gap-2 mx-auto mb-3">
                                        <button class="btn btn-danger" type="submit">
                                            Delete<span class="material-icons right-align">delete_forever</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@once
    @push('scripts')
        <script type="text/javascript" src="{{ asset('static/js/profile.js') }}"></script>
    @endpush
@endonce
