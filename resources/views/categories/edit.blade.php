<x-templates.default>
    <x-slot:pretitle>Edit Category</x-slot:pretitle>
    <x-slot:title>Categories</x-slot:title>

    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('categories.update', $category) }}" class="card" method="post">
                @csrf
                @method('PUT')
                <div class="card-header">Edit Category</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control form-control @error('name') is-invalid @enderror"
                            name="name" placeholder="category name" value="{{ old('name') ?? $category->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="card-footer">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-templates.default>
