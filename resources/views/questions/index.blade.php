@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @foreach($questions as $question)
                        <div class="media">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <div>
                                        <span class="subtext">
                                            {{ $question->votes }}
                                        </span>
                                        {{ Str::plural('vote', $question->votes) }}
                                    </div>
                                </div>
                                <div class="status {{ $question->status }}">
                                    <div>
                                        <span class="subtext">
                                            {{ $question->answers }}
                                        </span>
                                        {{ Str::plural('answer', $question->answers) }}
                                    </div>
                                </div>
                                <div class="views">
                                    <div>
                                        {{ $question->views . " " .Str::plural('view',      $question->views) }}
                                    </div>
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                    <p class="lead">
                                        Asked by <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        <small class="text-muted">{{ $question->created_date }}</small>
                                    </p>
                                </h3>
                                {{ Str::limit($question->body, 250) }}
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <div class="mx-auto d-flex justify-content-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
