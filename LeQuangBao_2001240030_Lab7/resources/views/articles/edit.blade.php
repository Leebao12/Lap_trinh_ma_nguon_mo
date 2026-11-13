@extends('layouts.app')
@section('title', 'Sửa bài viết')
@push('styles') 
    <style> 
    textarea:focus { outline: none; border-color: #2563eb; } 
    </style> 
@endpush 
@section('content')
    <h2>Sửa bài viết #{{ $article['id'] }}</h2>
    <form action="{{ route('articles.update', $article['id']) }}" method="post">
        @csrf
        @method('PUT')
        <x-input name="title" label="Tiêu đề" :value="$article['title']" />
        <label style="display:block;margin:8px 0 4px">Nội dung</label>
        <textarea name="body" rows="6" style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px">{{ old('body', $article['body']) }}</textarea>
        @error('body')
            <div style="color:#991B1B;margin-top:4px">{{ $message }}</div>
        @enderror
        <div style="margin-top:10px;"> 
            <x-button variant="primary">Cập nhật</x-button> 
        </div> 
    </form>
@endsection
