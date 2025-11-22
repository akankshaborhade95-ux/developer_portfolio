@extends('layouts.admin')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="page-title">
            <i class="fas fa-edit me-2 text-primary"></i>
            Edit Skill
        </h1>
        <a href="{{ route('skills.index') }}" class="btn btn-custom-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Skills
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card custom-card">
            <div class="card-body p-4">
                <form action="{{ route('skills.update', $skill) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Skill Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $skill->name) }}" required>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="percentage" class="form-label fw-bold">Proficiency Level *</label>
                        <input type="range" class="form-range" id="percentage" name="percentage" 
                               min="0" max="100" value="{{ old('percentage', $skill->percentage) }}"
                               oninput="updatePercentageValue(this.value)">
                        <div class="text-center mt-2">
                            <span id="percentageValue" class="fw-bold text-primary">{{ old('percentage', $skill->percentage) }}%</span>
                        </div>
                        @error('percentage')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="form-label fw-bold">Category *</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select a Category</option>
                            <option value="Frontend" {{ old('category', $skill->category) == 'Frontend' ? 'selected' : '' }}>Frontend Development</option>
                            <option value="Backend" {{ old('category', $skill->category) == 'Backend' ? 'selected' : '' }}>Backend Development</option>
                            <option value="Database" {{ old('category', $skill->category) == 'Database' ? 'selected' : '' }}>Database</option>
                            <option value="Mobile" {{ old('category', $skill->category) == 'Mobile' ? 'selected' : '' }}>Mobile Development</option>
                            <option value="DevOps" {{ old('category', $skill->category) == 'DevOps' ? 'selected' : '' }}>DevOps & Tools</option>
                            <option value="Design" {{ old('category', $skill->category) == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Other" {{ old('category', $skill->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="sort_order" class="form-label fw-bold">Display Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" 
                               value="{{ old('sort_order', $skill->sort_order) }}" min="0" max="100">
                        <div class="form-text">Skills are ordered from lowest to highest number.</div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   value="1" {{ old('is_active', $skill->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">
                                Active Skill
                            </label>
                        </div>
                        <div class="form-text">Inactive skills won't be shown on your portfolio.</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('skills.index') }}" class="btn btn-custom-secondary me-md-2">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-custom-primary">
                            <i class="fas fa-save me-1"></i>Update Skill
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updatePercentageValue(value) {
    document.getElementById('percentageValue').textContent = value + '%';
}

// Initialize the percentage value on page load
document.addEventListener('DOMContentLoaded', function() {
    const percentageSlider = document.getElementById('percentage');
    updatePercentageValue(percentageSlider.value);
});
</script>
@endsection