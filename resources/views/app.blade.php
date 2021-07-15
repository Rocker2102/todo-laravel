@extends('layouts.default')

@section('content')
    <main class="container mt-3">
        @if (count($todos['data']) == 0)
            <div class="alert alert-warning fade show m-3" role="alert">
                Nothing to display! Your tasks will be shown here
            </div>
        @else
            @php
                $accord_id = 'accord-todo-' . Helper::get_random_str(4);
            @endphp

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
                            {{-- data-bs-parent='#{{ $accord_id }}' --}}>
                            <div class='accordion-body accordian-ctm-bg'>
                                <p>
                                    <span class="lead">{{ $item['description'] ?? '-' }}</span><br>
                                    <span class="">
                                        Created at: <span class="text-primary">{{ $item['created_at'] }}</span>&nbsp;
                                        Last updated: <span class="text-primary">{{ $item['updated_at'] }}</span>
                                    </span>

                                    @isset ($item['due_date'])
                                        @php
                                            $due_date_msg = 'Remaining: ';
                                                $due_date_class = 'text-success';
                                                $diff = time() - strtotime($item['due_date']);
                                                if ($diff > 0) {
                                                    $due_date_msg = 'Overdue by: ';
                                                    $due_date_class = 'text-danger';
                                                }
                                                $curr = new DateTime(date('Y-m-d H:i:s'));
                                                $due_date = new DateTime($item['due_date']);
                                                $interval = $due_date->diff($curr, true);
                                                $days = $interval->format('%ad %hh');
                                                $due_date_msg .= $days;
                                        @endphp

                                        <br>
                                        Due date:
                                        <span class="{{ $due_date_class }}">
                                            {{ $item['due_date'] }}
                                            <em>({{ $due_date_msg }})</em>
                                        </span>
                                    @endisset
                                </p>
                                <div class="mt-2">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-outline-info" onclick="location.href='{{ route('app.todo.edit', $item['id']) }}'">
                                            <span class="material-icons left-align">edit</span>Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" linkurl="{{ route('todo.delete', $item['id']) }}" confirm>
                                            <span class="material-icons left-align">delete</span>Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <nav class="my-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $todos['first_page_url'] == url()->full() ? 'disabled' : '' }}" title="First Page">
                        <a class="page-link" href="{{ $todos['first_page_url'] }}">
                            <span class="material-icons">first_page</span>
                        </a>
                    </li>
                    <li class="page-item {{ $todos['prev_page_url'] == null ? 'disabled' : '' }}" title="Previous Page">
                        <a class="page-link" href="{{ $todos['prev_page_url'] }}" tabindex="-1">
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
            </nav>
        @endif
    </main>
@endsection
