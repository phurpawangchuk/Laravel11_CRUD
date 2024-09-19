<div>
    <!-- Add Product Button -->
    <x-authenticated-content>
        <button wire:click="showAdd" class="btn btn-primary mb-3">
            Add Review
        </button>
    </x-authenticated-content>

    <!-- Product List Table -->
    @include('livewire.posts._data')

    <!-- Modal for Add/Edit Product -->
    @include('livewire.posts._form')

</div>