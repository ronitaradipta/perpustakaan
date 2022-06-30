<x-templates.default>
    <x-slot:pretitle>Add Publisher</x-slot:pretitle>
    <x-slot:title>Publishers</x-slot:title>

    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('publishers.store') }}" class="card" method="post">
                @csrf
                <div class="card-header">Add Publisher</div>
                <div class="card-body">
                   <x-input-form name="name" placeholder="Publisher Name"/>
                   <x-input-form name="address" placeholder="Publisher Address"/>
                   <x-input-form name="phone" placeholder="Publisher Phone"/>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Save" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</x-templates.default>