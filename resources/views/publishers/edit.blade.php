<x-templates.default>
    <x-slot:pretitle>Edit Publisher</x-slot:pretitle>
    <x-slot:title>Publishers</x-slot:title>

    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('publishers.update', $publisher) }}" class="card" method="post">
                @csrf
                @method('PUT')
                <div class="card-header">Edit Publisher</div>
                <div class="card-body">
                   <x-input-form name="name" :currentData="$publisher->name" placeholder="Publisher Name"/>
                   <x-input-form name="address" :currentData="$publisher->address" placeholder="Publisher Address"/>
                   <x-input-form name="phone" :currentData="$publisher->phone" placeholder="Publisher Phone"/>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-templates.default>
