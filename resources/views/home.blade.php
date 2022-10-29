@extends('layouts.app')

@section('title', 'notepad')

@section('body')


    <div class="form-group mt-4">
        <h1>My Notepad</h1>


        <h2>New note</h2>
        <div>@include('info.errors')</div>
        <div>@include('note.new-note')</div>

        <h2>History of notes</h2>

        @foreach ($notes as $note)
            <div class="marg">
                <li class="table-style">{{ $note->name }} <p>
                        {{ $note->description }}</p>
                </li>
            </div>
        @endforeach
    </div>

@endsection
