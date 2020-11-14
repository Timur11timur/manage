@extends('layouts.app')

@section('header')
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form method="POST" action="/threads">
                            @csrf
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel:</label>
                                <select id="channel_id" class="form-control" name="channel_id" required>
                                    <option value="" selected disabled>Choose one ...</option>
                                    @foreach($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                    <wysiwyg name="body"></wysiwyg>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6Lduyt0ZAAAAAPw_73FYjzNl_kmL2C6W8fL2ZtzI"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            @if($errors->any())
                                <ul class="alert alert-danger" role="alert">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
