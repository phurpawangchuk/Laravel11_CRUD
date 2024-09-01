   <x-dialog-modal id="deleteConfirmationModal" wire:model.defer="confirmingDelete">
       <x-slot name="title">
           Confirm Deletion
       </x-slot>

       <x-slot name="content">
           <p>Are you sure you want to delete this product?</p>
       </x-slot>

       <x-slot name="footer">
           <x-secondary-button wire:click="$set('confirmingDelete', false)">
               Cancel
           </x-secondary-button>

           <x-button class="ml-2" wire:click="confirmDelete">
               Delete
           </x-button>
       </x-slot>
   </x-dialog-modal>