@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Testimonials</h1>
    <a href="{{ route('testimonials.create') }}" class="btn btn-primary">Add New Testimonial</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        @if($testimonials->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Position</th>
                        <th>Rating</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->client_name }}</td>
                        <td>{{ $testimonial->client_position ?? 'N/A' }}</td>
                        <td>
                            <div class="text-warning">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </td>
                        <td>{{ Str::limit($testimonial->content, 50) }}</td>
                        <td>
                            <span class="badge {{ $testimonial->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('testimonials.edit', $testimonial) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('testimonials.destroy', $testimonial) }}" method="POST" class="d-inline">
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
        <p class="text-muted">No testimonials found. <a href="{{ route('testimonials.create') }}">Create your first testimonial</a></p>
        @endif
    </div>
</div>
@endsection