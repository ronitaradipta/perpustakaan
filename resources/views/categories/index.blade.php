<x-templates.default>
    <x-slot:pretitle>Data Categories</x-slot:pretitle>
    <x-slot:title>Categories</x-slot:title>
    <x-slot:page_action>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    </x-slot:page_action>

    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-info">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-templates.default>
