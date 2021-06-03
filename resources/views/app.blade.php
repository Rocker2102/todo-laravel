@extends('layouts.default')

@section('content')
    <main class="container mt-3">
        @php
            $accord_id = 'accord-todo-' . Helper::get_random_str(4);
        @endphp

        @if (count($todos['data']) == 0)
            <div class="alert alert-warning fade show m-3" role="alert">
                Nothing to display! Your tasks will be shown here
            </div>
        @endif

        <div class="accordian m-3" id='{{ $accord_id }}'>
            @foreach ($todos['data'] as $item)
                @php
                    $item_id = $accord_id . '-item-' . $loop->iteration;
                    $header_id = $accord_id . '-header-' . $loop->iteration;
                @endphp

                <div class='accordion-item'>
                    <h2 class='accordion-header' id='{{ $header_id }}'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#{{ $item_id }}'
                            aria-expanded='false' aria-controls='{{ $item_id }}'>
                            <span class="material-icons"></span>{{ $loop->iteration }}. {{ $item['title'] }}
                        </button>
                    </h2>

                    <div id='{{ $item_id }}' class='accordion-collapse collapse' aria-labelledby={{ $header_id }}
                        data-bs-parent='#{{ $accord_id }}'>
                        <div class='accordion-body accordian-ctm-bg'>
                            <span>{{ $item['description'] }}</span>
                            <div class='mt-2'>
                                <div class='btn-group' role='group'>
                                    <button type='button' class='btn btn-outline-info' data-ctm-action='connect'>
                                        <span class='material-icons left-align'>edit</span>Edit
                                    </button>
                                    <button type='button' class='btn btn-outline-danger' data-ctm-action=''>
                                        <span class='material-icons left-align'>delete</span>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <nav class="my-3">
            @if (count($todos['data']) != 0)
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $todos['first_page_url'] == url()->full() ? 'disabled' : '' }}" title="First Page">
                        <a class="page-link" href="{{ $todos['first_page_url'] }}">
                            <span class="material-icons">first_page</span>
                        </a>
                    </li>
                    <li class="page-item {{ $todos['prev_page_url'] == null ? 'disabled' : '' }}" title="Previous Page">
                        <a class="page-link" href="{{ $todos['prev_page_url'] }}" tabindex="-1" aria-disabled="true">
                            <span class="material-icons">navigate_before</span>
                        </a>
                    </li>
                    @foreach ($todos['links'] as $nav)
                        @if (is_numeric($nav['label']))
                            <li class="page-item {{ $nav['active'] || $nav['url'] == null ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $nav['url'] }}">{{ $nav['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                    <li class="page-item {{ $todos['next_page_url'] == null ? 'disabled' : '' }}" title="Next Page">
                        <a class="page-link" href="{{ $todos['next_page_url'] }}">
                            <span class="material-icons">navigate_next</span>
                        </a>
                    </li>
                    <li class="page-item {{ $todos['last_page_url'] == url()->full() ? 'disabled' : '' }}" title="Last Page">
                        <a class="page-link" href="{{ $todos['last_page_url'] }}">
                            <span class="material-icons">last_page</span>
                        </a>
                    </li>
                </ul>
            @endif
        </nav>

    </main>
@endsection
