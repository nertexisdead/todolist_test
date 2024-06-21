@extends('front.layouts.app')

@section('content')

    <div class="container">
        <div class="text-center mt-3">
            <a href="{{ ENV('APP_URL') }}/lists">Перейти к спискам ToDo</a>
        </div>
    </div>

@endsection
