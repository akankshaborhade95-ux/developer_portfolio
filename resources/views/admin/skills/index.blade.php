@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="page-title">
            <i class="fas fa-cog me-2 text-primary"></i>
            Manage Skills
        </h1>
        <a href="{{ route('skills.create') }}" class="btn btn-custom-primary">
            <i class="fas fa-plus me-1"></i>Add New Skill
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success custom-card">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger custom-card">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
    </div>
@endif

<div class="card custom-card">
    <div class="card-body">
        @if($skills && $skills->count() > 0)
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Skill Name</th>
                        <th>Category</th>
                        <th>Proficiency</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                    <tr>
                        <td class="fw-bold text-dark">{{ $skill->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $skill->category }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 me-3">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ $skill->percentage }}%"></div>
                                    </div>
                                </div>
                                <span class="text-muted small">{{ $skill->percentage }}%</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $skill->sort_order }}</td>
                        <td>
                            <span class="badge {{ $skill->is_active ? 'bg-success' : 'bg-secondary' }} badge-custom">
                                <i class="fas fa-circle me-1" style="font-size: 6px;"></i>
                                {{ $skill->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('skills.edit', $skill) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('skills.destroy', $skill) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this skill?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-code fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No Skills Added Yet</h5>
            <p class="text-muted mb-4">Start by adding your technical skills and proficiencies.</p>
            <a href="{{ route('skills.create') }}" class="btn btn-custom-primary">
                <i class="fas fa-plus me-1"></i>Add First Skill
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Quick Stats -->
@if($skills && $skills->count() > 0)
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h3 class="text-primary mb-1">{{ $skills->count() }}</h3>
                <p class="text-muted mb-0">Total Skills</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h3 class="text-success mb-1">{{ $skills->where('is_active', true)->count() }}</h3>
                <p class="text-muted mb-0">Active Skills</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h3 class="text-warning mb-1">{{ number_format($skills->avg('percentage'), 1) }}%</h3>
                <p class="text-muted mb-0">Avg. Proficiency</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h3 class="text-info mb-1">{{ $skills->unique('category')->count() }}</h3>
                <p class="text-muted mb-0">Categories</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection