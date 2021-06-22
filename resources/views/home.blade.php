@extends('layouts.app')

@section('content')
    <h6>Your pastes</h6>
    <div class="col-13 col-lg-4 my-3">
        @if (session('status'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (count($pastes) > 0)
        <ul class="list-group mb-3">
            @foreach ($pastes as $paste)
                <li class="list-group-item">
                    <a href="{{url("/{$paste->url_path}")}}">{{ $paste->name  }}</a><br>
                    <small class="text-muted text-capitalize fs-7">
                        {{ $paste->language }}
                        | {{ $paste->created_at->diffForHumans() }}
                        | {{ $paste->access_type }}
                    </small>
                </li>
            @endforeach
        </ul>
        @endif
        {{  $pastes->render()  }}
    </div>
@endsection
