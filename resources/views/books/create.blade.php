<x-templates.default>
    <x-slot:pretitle>Add Book</x-slot:pretitle>
    <x-slot:title>Books</x-slot:title>

    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('books.store') }}" class="card" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">Add Book</div>
                <div class="card-body">
                   <x-input-form name="title" placeholder="Book Title"/>
                   <div class="mb-3">
                    <label class="form-label">Cover</label>
                    <input type="file" name="cover" id="" class="form-control">
                   </div>
                   <x-input-form name="published_at" type="date" placeholder="Release date"/>
                   <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category_id" id="" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                   </div>
                   <div class="mb-3">
                        <label for="" class="form-label">Publisher</label>
                        <select name="publisher_id" id="" class="form-select">
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                   </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-templates.default>