@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Testimonial</h1>
    <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Back to Testimonials</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">Client Name *</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" value="{{ $testimonial->client_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client_position" class="form-label">Client Position</label>
                                <input type="text" class="form-control" id="client_position" name="client_position" value="{{ $testimonial->client_position }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Testimonial Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required>{{ $testimonial->content }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating *</label>
                        <select class="form-select" id="rating" name="rating" required>
                            <option value="5" {{ $testimonial->rating == 5 ? 'selected' : '' }}>★★★★★ (5 Stars)</option>
                            <option value="4" {{ $testimonial->rating == 4 ? 'selected' : '' }}>★★★★☆ (4 Stars)</option>
                            <option value="3" {{ $testimonial->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3 Stars)</option>
                            <option value="2" {{ $testimonial->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2 Stars)</option>
                            <option value="1" {{ $testimonial->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 Star)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label">Client Avatar</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        @if($testimonial->avatar)
                        <div class="mt-2">
                            <small>Current avatar: {{ $testimonial->avatar }}</small>
                        </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $testimonial->sort_order }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Testimonial</button>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection