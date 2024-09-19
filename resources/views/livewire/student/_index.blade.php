<div>
    <!-- Add Product Button -->
    <x-authenticated-content>
        <button wire:click="showAdd" class="btn btn-primary mb-3">
            Add Student
        </button>
    </x-authenticated-content>

    @include('livewire.student._data')
    @include('livewire.student._form')
    
    <x-delete title="Student"></x-delete>

</div>