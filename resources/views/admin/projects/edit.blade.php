@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Skill</h1>
    <a href="{{ route('skills.index') }}" class="btn btn-secondary">Back to Skills</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('skills.update', $skill) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Skill Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="percentage" class="form-label">Percentage *</label>
                        <input type="range" class="form-range" id="percentage" name="percentage" min="0" max="100" value="{{ $skill->percentage }}">
                        <div class="text-center">
                            <span id="percentageValue">{{ $skill->percentage }}%</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Frontend" {{ $skill->category == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                            <option value="Backend" {{ $skill->category == 'Backend' ? 'selected' : '' }}>Backend</option>
                            <option value="Database" {{ $skill->category == 'Database' ? 'selected' : '' }}>Database</option>
                            <option value="Mobile" {{ $skill->category == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                            <option value="DevOps" {{ $skill->category == 'DevOps' ? 'selected' : '' }}>DevOps</option>
                            <option value="Other" {{ $skill->category == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ $skill->sort_order }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $skill->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Skill</button>
                    <a href="{{ route('skills.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const percentageSlider = document.getElementById('percentage');
    const percentageValue = document.getElementById('percentageValue');

    percentageSlider.addEventListener('input', function() {
        percentageValue.textContent = this.value + '%';
    });
</script>
@endsection