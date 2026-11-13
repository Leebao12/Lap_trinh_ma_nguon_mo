@extends('layouts.app')
@section('title', 'Thêm sinh viên')
@section('content')
<x-card title="Thêm sinh viên mới">
    <form method="POST" action="{{ url('/students') }}">
        @csrf
        {{-- Họ tên --}}
        <div style="margin-bottom: 15px;">
            <label for="name">
                <strong>Họ tên:</strong>
            </label>
            <br>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                style="width: 350px; padding: 8px;">
            @error('name')
                <div style="color: red; margin-top: 5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label for="email">
                <strong>Email:</strong>
            </label>
            <br>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                style="width: 350px; padding: 8px;">
            @error('email')
                <div style="color: red; margin-top: 5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- Tuổi --}}
        <div style="margin-bottom: 15px;">
            <label for="age">
                <strong>Tuổi:</strong>
            </label>
            <br>
            <input
                type="number"
                id="age"
                name="age"
                value="{{ old('age') }}"
                min="16"
                style="width: 350px; padding: 8px;">
            @error('age')
                <div style="color: red; margin-top: 5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- Giới tính --}}
        <div style="margin-bottom: 15px;">
            <label for="gender">
                <strong>Giới tính:</strong>
            </label>
            <br>
            <select
                name="gender"
                id="gender"
                style="width: 370px; padding: 8px;">
                <option value="">-- Chọn giới tính --</option>
                <option
                    value="male"
                    @selected(old('gender') === 'male')>
                    Nam
                </option>
                <option
                    value="female"
                    @selected(old('gender') === 'female')>
                    Nữ
                </option>
            </select>
            @error('gender')
                <div style="color: red; margin-top: 5px;">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" style="padding: 8px 16px;">
            Thêm sinh viên
        </button>
        <a
            href="{{ url('/students/db') }}"
            style="margin-left: 10px;">
            Quay lại
        </a>
    </form>
</x-card>
@endsection