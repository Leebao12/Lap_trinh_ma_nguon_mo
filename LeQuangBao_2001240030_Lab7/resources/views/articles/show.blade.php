@extends('layouts.app')
@section('title', $article['title'])
@section('content')
    <h2>{{ $article['title'] }}</h2>
    <p style="color:#6b7280; font-size:13px;">
        ID: #{{ $article['id'] }}

    </p>
    <div style="margin: 16px 0; line-height: 1.6;"> 
        {{ $article['body'] }}
    </div>
    <a href="{{ route('articles.index') }}">Quay lại</a>
@endsection
