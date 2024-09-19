<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;

use Illuminate\Support\Facades\Storage;

class PostManager extends Component
{
    use WithFileUploads;

    public $postId,$title, $description, $image;
    public $postIdToDelete = null;
    public $confirmingDelete = false;
    public $showAddModal = false;
    public $updateMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string'
    ];

    public function mount(){   
        $this->posts = Post::paginate(10);
     }

    public function render()
    {
        return view('livewire.posts._index', [
                'posts' => Post::where('user_id', auth()->user()->id)->paginate(10),
        ]);
    }

     public function store()
    {
        // Make image required when creating a post
        $this->validate(array_merge($this->rules, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]));

        $post = new Post();
        $post->title = $this->title;
        $post->description = $this->description;
        $post->user_id = auth()->id();

        if ($this->image) {
            $file = $this->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/posts', $filename); 
             // Store the file on S3 with the custom filename
            // $path = $file->storeAs('uploads', $filename, 's3');
            // $url = Storage::disk('s3')->url($path);

            $post->image = $filename;
        }

        $post->save();

        session()->flash('message', 'Post created successfully.');

        $this->resetFields();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->showAddModal = true; 
        $post = Post::findOrFail($id);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        // $this->image = $post->image ? Storage::url($post->image) : null;
        $this->image = null;
    }

    public function update()
    {
        // Only require image validation if a new image is uploaded
        if ($this->image instanceof \Livewire\TemporaryUploadedFile) {
            $rules['image'] = 'nullable|image|mimes:jpg,png,jpeg|max:2048';
        }
        
        $this->validate();

        $post = Post::find($this->postId);
        $post->title = $this->title;
        $post->description = $this->description;
        if($this->image){
            Storage::disk('public')->delete($post->image);
            $file = $this->image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/posts', $filename); 
            $post->image = $filename;
        }
        $post->save();
        session()->flash('message', 'Post updated successfully.');
        $this->resetFields();
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function delete($id)
    {
        $this->postIdToDelete = $id; // Store the ID of the post to delete
        $this->confirmingDelete = true; // Show the confirmation modal
    }

    private function resetFields()
    {
        $this->reset(['title', 'description', 'image']);
        $this->showAddModal = false;
        $this->updateMode = false;
    }

    public function confirmDelete()
    {
        if ($this->postIdToDelete) {
            $post = Post::find($this->postIdToDelete);
            if ($post) {
                $post->delete();
                session()->flash('message', 'Post deleted successfully.');
                $this->postIdToDelete = null;
                $this->confirmingDelete = false;
            }
        }
    }

    public function showAdd()
    {
         $this->showAddModal = true;
    }
}