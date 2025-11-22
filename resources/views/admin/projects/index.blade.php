@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Projects</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add New Project</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Technologies</th>
                        <th>URLs</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{ $project->title }}</td>
                        <td>
                            @foreach($project->technologies as $tech)
                            <span class="badge bg-primary me-1">{{ $tech }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="btn btn-sm btn-outline-primary">Live</a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-dark">GitHub</a>
                            @endif
                        </td>
                        <td>{{ $project->sort_order }}</td>
                        <td>
                            <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $project->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">No projects found. <a href="{{ route('projects.create') }}">Create your first project</a></p>
        @endif
    </div>
</div>
@endsection