@extends('layouts.layout')

@section('title', 'Create Project')

@section('content')
    <h1>Create a New Project</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                required
            >
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                class="form-control" 
                id="description" 
                name="description"
            >{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input 
                type="date" 
                class="form-control" 
                id="deadline" 
                name="deadline" 
                value="{{ old('deadline') }}" 
                required
            >
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
