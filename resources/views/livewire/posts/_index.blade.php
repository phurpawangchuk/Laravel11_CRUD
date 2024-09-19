<div>
    <!-- Add Product Button -->
    <x-authenticated-content>
        <button wire:click="showAdd" class="btn btn-primary mb-3">
            Add Post
        </button>
    </x-authenticated-content>

    <!-- Flash Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <!-- Product List Table -->
    @include('livewire.posts._data')

    <!-- Modal for Add/Edit Product -->
    @include('livewire.posts._form')

    <!-- Delete Confirmation Modal -->
    <x-delete title="Post"></x-delete>

</div>