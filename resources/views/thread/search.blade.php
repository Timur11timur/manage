@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <search-results :query="'{{ request('q') }}'" :appid="'{{ config('scout.algolia.id') }}'" :apikey="'{{ config('scout.algolia.key') }}'">
                </search-results>
            </div>
            <div class="col-md-4">

                @if(count($trendings))
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            Trending threads
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($trendings as $thread)
                                    <li class="list-group-item">
                                        <a href="{{ url($thread->path) }}">
                                            {{ $thread->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
