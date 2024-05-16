@extends('layouts.app')

@section('title', 'Welcome Page')

@section('content')


        <h1>{{ __('messages.registration_success') }}</h1>
        <p>{{ __('messages.welcome') }} </p>
        <h4>{{ Session::get('registered_user')->user_name }}</h4>
        <img src="{{ asset('storage/' . Session::get('registered_user')->user_image) }}" alt="{{ Session::get('registered_user')->full_name }}">
        <div class="button-container">
            <a href="{{ route('register') }}">{{ __('messages.register_another_user') }}</a>
        </div>
@endsection 
