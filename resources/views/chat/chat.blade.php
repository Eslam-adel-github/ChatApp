@extends('layouts.app')

@section('content')
    <div class="container">
        <chat-component :current_user="{{ auth()->user() }}"></chat-component>
    </div>
@endsection
