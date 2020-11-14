@extends('layouts.app')

@section('content')
    <div class="container">
        <search-view :appid="'{{ config('scout.algolia.id') }}'" :apikey="'{{ config('scout.algolia.key') }}'">
        </search-view>
    </div>
@endsection
