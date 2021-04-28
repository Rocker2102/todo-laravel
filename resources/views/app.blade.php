@extends('layouts.default')

@section('content')
    <main class="container mt-3">
        <form id="accessForm" class="form-floating m-3">
            @csrf
            <div class="form-floating mb-3">
                <input id="accessCodeField" type="password" name="access_code" class="form-control" placeholder="Access Code" required>
                <label for="accessCodeField">Access Code</label>
                <div class="invalid-feedback">
                    Recheck the access code & try again!
                </div>
            </div>
            <div class="d-grid gap-2 mx-auto mb-3">
                <button class="btn btn-success" type="submit">
                    Verify<span class="material-icons right-align">keyboard_arrow_right</span>
                </button>
            </div>
        </form>
    </main>
@endsection
