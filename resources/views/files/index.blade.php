@extends('layouts.sidebars')

@section('content')
    @foreach ($filesCollection as $file)
        <p>{{ $file['name'] }}</p>
        </br>
    @endforeach

    <fileupload></fileupload>

@endsection