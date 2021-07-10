@extends('layouts.default', ['title' => 'Edit Item'])

@section('content')
    <main class="container mt-3">
        @include('includes.err-accordian')

        <form id="editTodoForm" class="form-floating m-3" action="{{ route('todo.update', $todo['id']) }}" method="POST">
            <h4>Edit Item #{{ $todo['id'] }}</h4>
            @method('POST')
            @csrf

            <div class="row g-2">
                <div class="col-sm-12 mb-3">
                    <div class="form-floating">
                        <input type="text" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            placeholder="Title" name="title" value="{{ old('title') ?? $todo['title'] }}" required>
                        <label for="title">Title</label>
                    </div>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="desciption" class="form-label">Add a description</label>
                    <textarea class="form-control" id="desciption" rows="3" name="description">{{ old('description') ?? $todo['description'] }}</textarea>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-md-4 mb-3">
                    @php
                        $due_date = old('due_date') ?? $todo['due_date'];
                        $due_date = isset($due_date)
                            ? date('Y-m-d\TH:i:s', strtotime($todo['due_date']))
                            : '';
                    @endphp
                    <div class="form-floating">
                        <input type="datetime-local" id="due_date" class="form-control"
                            placeholder="Due Date" name="due_date" value="{{ $due_date }}">
                        <label for="due_date">Due Date</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="datetime-local" id="created_at" class="form-control"
                            placeholder="Created At" value="{{ date('Y-m-d\TH:i:s', strtotime($todo['created_at'])) }}" readonly>
                        <label for="created_at">Created At</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-floating">
                        <input type="datetime-local" id="last_updated" class="form-control"
                            placeholder="Last Updated" value="{{ date('Y-m-d\TH:i:s', strtotime($todo['updated_at'])) }}" readonly>
                        <label for="last_updated">Last Updated</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 d-grid gap-1 mx-auto mb-3">
                    <button class="btn btn-primary" type="button" onclick="location.href='{{ route('app.home') }}'">
                        <span class="material-icons left-align">keyboard_arrow_left</span>Go Back
                    </button>
                </div>
                <div class="col-sm-3 d-grid gap-1 mx-auto mb-3">
                    <button class="btn btn-danger" type="reset">
                        <span class="material-icons left-align">undo</span>Reset
                    </button>
                </div>
                <div class="col-sm-6 d-grid gap-1 mx-auto mb-3">
                    <button class="btn btn-success" type="submit">
                        Update<span class="material-icons right-align">update</span>
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection
