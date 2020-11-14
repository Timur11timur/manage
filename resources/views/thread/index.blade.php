@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('thread.layouts.list')

                {{ $threads->render() }}
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Search
                    </div>
                    <div class="card-body">
                        <form method="GET" action="/threads/search">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something ..." name="q" class="form-control">
                            </div>

                            <div class="form-group mb-0">
                                <button class="btn btn-default border" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

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
