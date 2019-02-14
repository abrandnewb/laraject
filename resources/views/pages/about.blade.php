@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <p>These are our services</p>
    @if(count($services) > 0)
        <ul class="list-group">
            @foreach( $services as $service)
                <li class="list-group-item">{{ $service }}</li>
            @endforeach
        </ul>    
    @endif

    {{-- @forelse ($services as $service)
        <li>{{ $service }}</li>
    @empty
        <p>No Services</p>
    @endforelse --}}
@endsection