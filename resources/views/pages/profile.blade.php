@extends('layouts.app')
@section('content')
@if(Auth::check() && Auth::user()->role === 'murid')
    @include('admin.sidebar-user') 
@else
    @include('admin.sidebar')
@endif

<div class="container">
    <h2>Profile</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>
    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary" style="margin-top: 10px;">Edit</a>
</div>
@endsection
