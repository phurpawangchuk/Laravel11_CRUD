<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\State;
use App\Models\City;

use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithFileUploads;
 
    public $productId, $name, $price, $description,$image;
    public $productIdToDelete = null; 
    public $confirmingDelete = false; 
    public $showAddModal = false;
    public $updateMode = false;
    public $states,$cities;
  
    public $selectedState = null;
    public $selectedCity = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
    ];

    public function mount(){
        $this->states = State::all();
        $this->cities = [];
    }

    public function updatedSelectedState($stateId)
    {
        $this->cities = City::where('state_id', $stateId)->get();
    }
    
    public function render()
    {
        if(auth()->user()){
            return view('livewire.product._index', [
                 'products' => Product::where('user_id', auth()->user()->id)->paginate(10),
            ]);
        }else{
            return view('livewire.product._index', [
                 'products' => Product::paginate(10),
            ]);
        }
    }

    public function store()
    {
        // Make image required when creating a product
        $this->validate(array_merge($this->rules, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]));

        $product = new Product();
        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;
        $product->user_id = auth()->id();

        if ($this->image) {
            //$imagePath = $this->image->store('images', 'public');
            $file = $this->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $filename); 
             // Store the file on S3 with the custom filename
            // $path = $file->storeAs('uploads', $filename, 's3');
            // $url = Storage::disk('s3')->url($path);

            $product->image = $filename;
        }

        $product->save();

        session()->flash('message', 'Product created successfully.');

        $this->resetFields();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->showAddModal = true; 
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->image = $product->image ? Storage::url($product->image) : null;
    }

    public function update()
    {
        // Only require image validation if a new image is uploaded
        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            $rules['image'] = 'nullable|image|mimes:jpg,png,jpeg|max:2048';
        }
        
        $this->validate();

        $product = Product::find($this->productId);
        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;

        // Check if a new image is uploaded
        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            // Optionally delete the old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image and update the path
            $imagePath = $this->image->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        session()->flash('message', 'Product updated successfully.');

        $this->resetFields();
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function delete($id)
    {
        $this->productIdToDelete = $id; // Store the ID of the product to delete
        $this->confirmingDelete = true; // Show the confirmation modal
    }

    private function resetFields()
    {
        $this->reset(['name', 'price', 'description', 'image']);
        $this->showAddModal = false;
        $this->updateMode = false;
    }

    public function confirmDelete()
    {
        if ($this->productIdToDelete) {
            $product = Product::find($this->productIdToDelete);
            if ($product) {
                $product->delete();
                session()->flash('message', 'Product deleted successfully.');
                $this->productIdToDelete = null;
                $this->confirmingDelete = false;
            }
        }
    }

    public function showAdd()
    {
         $this->showAddModal = true;
    }
}