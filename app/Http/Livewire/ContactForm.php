<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        $details = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];

        // Send email
        Mail::to('phurpawangchuk20@gmail.com')->send(new ContactFormMail($details));

        session()->flash('message', 'Your message has been sent successfully!');

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->message = '';
    }

    public function render()
    {
       return view('livewire.contact-form');
    }
}