@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-2">
                <ul class="list-group">
                    <li role="list-group-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                    <li role="list-group-item"><a href="{{ route('admin.channels.index') }}">Channels</a></li>
                </ul>
            </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        @yield('administration-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
