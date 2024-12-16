@extends('layouts.layout')

@section('title', 'Project Details')

@section('content')
    <h1>{{ $project->name }}</h1>

    <p>
        <strong>Description:</strong> 
        {{ $project->description ?: 'No description provided.' }}
    </p>
    <p>
        <strong>Deadline:</strong> 
        {{ \Carbon\Carbon::parse($project->deadline)->format('F d, Y') }}
    </p>
    <p>
        <strong>User:</strong> 
        {{ $project->user->name }}
    </p>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
        Back to List
    </a>
@endsection
