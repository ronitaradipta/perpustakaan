<x-templates.default>
    <x-slot:pretitle>Add Category</x-slot:pretitle>
    <x-slot:title>Categories</x-slot:title>

    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('categories.store') }}" class="card" method="post">
                @csrf
                <div class="card-header">Add Category</div>
                <div class="card-body">
                     <x-input-form name="name" placeholder="Category Name" />
                </div>
                <div class="card-footer">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-templates.default>
