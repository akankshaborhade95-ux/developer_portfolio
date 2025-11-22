@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Project</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Project Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="technologies" class="form-label">Technologies *</label>
                        <input type="text" class="form-control" id="technologies" name="technologies" 
                               placeholder="Laravel, Vue.js, MySQL, Bootstrap" required>
                        <div class="form-text">Separate technologies with commas</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_url" class="form-label">Project URL</label>
                                <input type="url" class="form-control" id="project_url" name="project_url">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="github_url" class="form-label">GitHub URL</label>
                                <input type="url" class="form-control" id="github_url" name="github_url">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Project</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection