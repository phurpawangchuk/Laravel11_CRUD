<div>
    <!-- Add Product Button -->
    <x-authenticated-content>
        <button wire:click="showAdd" class="btn btn-primary mb-3">
            Add Product
        </button>
    </x-authenticated-content>

    <!-- Product List Table -->
    @include('livewire.product._data')

    <!-- Modal for Add/Edit Product -->
    @include('livewire.product._form')

    <!-- Delete Confirmation Modal -->
    @include('livewire.product._delete')

</div>