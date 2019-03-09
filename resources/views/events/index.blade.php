@extends('layouts.app')
@section('content')
    @if(count($events) > 0)
        <table class="table table-stripped">
            <tr>
                <th>Id</th>
                <th>Event Name</th>
                <th>Item</th>
                <th>User</th>
                <th>Date</th>
            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->event_item}}</td>
                    <td>{{$event->user}}</td>
                    <td>{{$event->created_at}}</td>
                </tr>
            @endforeach
        </table>    
    @else
    <p>There are no events.</p>
    @endif
@endsection