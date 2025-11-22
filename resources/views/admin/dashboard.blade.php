@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt me-2 text-green"></i>
                Dashboard Overview
            </h1>
            <p class="text-muted mb-0">Welcome to your portfolio management dashboard</p>
        </div>
        <div class="btn-group">
            <a href="/" class="btn btn-custom-secondary me-2" target="_blank">
                <i class="fas fa-eye me-1"></i>View Live Site
            </a>
            <a href="{{ route('projects.create') }}" class="btn btn-custom-primary">
                <i class="fas fa-plus me-1"></i>Add Project
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success custom-card">
        <i class="fas fa-check-circle me-2 text-success"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger custom-card">
        <i class="fas fa-exclamation-circle me-2 text-danger"></i>
        {{ session('error') }}
    </div>
@endif

<!-- Statistics Cards -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card-primary custom-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-2">PROJECTS</h6>
                        <h2 class="text-white mb-0">{{ $projectsCount }}</h2>
                        <small class="text-white-50">Total Projects</small>
                    </div>
                    <div class="icon-bg bg-white-20">
                        <i class="fas fa-project-diagram fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card-success custom-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-2">SKILLS</h6>
                        <h2 class="text-white mb-0">{{ $skillsCount }}</h2>
                        <small class="text-white-50">Technical Skills</small>
                    </div>
                    <div class="icon-bg bg-white-20">
                        <i class="fas fa-code fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card-warning custom-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-2">TESTIMONIALS</h6>
                        <h2 class="text-white mb-0">{{ $testimonialsCount }}</h2>
                        <small class="text-white-50">Client Reviews</small>
                    </div>
                    <div class="icon-bg bg-white-20">
                        <i class="fas fa-comment fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card-info custom-card h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-2">TOTAL</h6>
                        <h2 class="text-white mb-0">{{ $projectsCount + $skillsCount + $testimonialsCount }}</h2>
                        <small class="text-white-50">All Items</small>
                    </div>
                    <div class="icon-bg bg-white-20">
                        <i class="fas fa-chart-pie fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Projects -->
<div class="row">
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header bg-transparent border-0 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-dark-green">
                        <i class="fas fa-clock me-2 text-green"></i>Recent Projects
                    </h5>
                    <a href="{{ route('projects.create') }}" class="btn btn-custom-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>New Project
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($recentProjects->count() > 0)
                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Technologies</th>
                                <th>Date Added</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProjects as $project)
                            <tr>
                                <td class="fw-bold text-dark-green">{{ $project->title }}</td>
                                <td>
                                    @foreach(array_slice($project->technologies, 0, 2) as $tech)
                                    <span class="badge bg-light text-dark border me-1">{{ trim($tech) }}</span>
                                    @endforeach
                                    @if(count($project->technologies) > 2)
                                    <span class="badge bg-secondary">+{{ count($project->technologies) - 2 }}</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $project->created_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }} badge-custom">
                                        <i class="fas fa-circle me-1" style="font-size: 6px;"></i>
                                        {{ $project->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this project?')">
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
                    <div class="icon-bg bg-green-10 mb-3 mx-auto" style="width: 80px; height: 80px;">
                        <i class="fas fa-inbox fa-2x text-green"></i>
                    </div>
                    <h5 class="text-dark-green">No Projects Yet</h5>
                    <p class="text-muted mb-4">Start by adding your first project to showcase your work.</p>
                    <a href="{{ route('projects.create') }}" class="btn btn-custom-primary">
                        <i class="fas fa-plus me-1"></i>Add First Project
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card custom-card">
            <div class="card-header bg-transparent border-0 py-4">
                <h5 class="card-title mb-0 text-dark-green">
                    <i class="fas fa-bolt me-2 text-green"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('projects.create') }}" class="btn btn-custom-primary w-100 h-100 py-4 text-decoration-none">
                            <div class="icon-bg bg-white-20 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                <i class="fas fa-project-diagram fa-2x text-white"></i>
                            </div>
                            <strong>Add Project</strong>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('skills.create') }}" class="btn btn-custom-primary w-100 h-100 py-4 text-decoration-none">
                            <div class="icon-bg bg-white-20 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                <i class="fas fa-code fa-2x text-white"></i>
                            </div>
                            <strong>Add Skill</strong>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ route('testimonials.create') }}" class="btn btn-custom-primary w-100 h-100 py-4 text-decoration-none">
                            <div class="icon-bg bg-white-20 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                <i class="fas fa-comment fa-2x text-white"></i>
                            </div>
                            <strong>Add Testimonial</strong>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <a href="/" class="btn btn-custom-secondary w-100 h-100 py-4 text-decoration-none" target="_blank">
                            <div class="icon-bg bg-green-10 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                <i class="fas fa-eye fa-2x text-green"></i>
                            </div>
                            <strong>View Portfolio</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-green-10 {
    background: rgba(94, 124, 114, 0.1) !important;
}
.bg-white-20 {
    background: rgba(227, 199, 199, 0.2) !important;
}
</style>
@endsection