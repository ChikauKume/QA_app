@if ($model instanceof App\Models\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp

@elseif($model instanceof App\Models\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp

@endif

@php
    $formId = $name . "-" . $model->id;
    $formAction = '#';
    // $formAction = "/{{ $firstURISegment }}/{{ $model->id }}/vote"
@endphp

<div class="d-flex flex-column vote-controls">

    {{-- up-vote --}}
    <a title="This {{ $name }} is useful" 
    class="vote-up {{ Auth::guest() ? 'off' : ''}}"
    onclick="event.preventDefault(); 
    document.getElementById('up-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form id="up-vote-{{ $formId }}" action="{{ $formAction }}" method="POST">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    
    {{-- vote value --}}
    <span class="votes-count">{{ $model->votes_count }}</span>
    
    {{-- down-vote --}}
    <a title="This {{ $name }} is not useful" 
    class="vote-down {{ Auth::guest() ? 'off' : ''}}"
    onclick="event.preventDefault(); 
    document.getElementById('down-vote-{{ $formId }}').submit();">
        <i class="fas fa-caret-down fa-3x"></i>
    </a>

    <form id="down-vote-{{ $formId }}" action="{{ $formAction }}" method="POST">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if ($model instanceof App\Models\Question)
        @include('shared._favorite', [
            'model' => $model
        ])
    @elseif ($model instanceof App\Models\Answer)
        @include('shared._accept', [
            'model' => $model
        ])
    @endif

</div>