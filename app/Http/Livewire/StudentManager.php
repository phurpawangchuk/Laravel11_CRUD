<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Student;
use App\Models\Course;

class StudentManager extends Component
{
    use WithFileUploads;

    public $course_id, $email, $grade, $category, $repeat,$name, $gender, $credits, $studentId;
    public $studentIdToDelete = null;
    public $confirmingDelete = false;
    public $showAddModal = false;
    public $updateMode = false;
    public $courses = [];

    protected $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|string|max:50',
        'course_id' => 'required',
        'gender' => 'required',
        'credits' => 'required|integer|max:10',
        'category' => 'required|string|max:50',
        'repeat' => 'required',
    ];

    public $repeatOptions = [
        ['id' => 'Y', 'name' => 'Yes'],
        ['id' => 'N', 'name' => 'No'],
    ];


    public function mount()
    {
        $this->courses = Course::all();
    }

    public function render()
    {

        if(auth()->user()){
            return view('livewire.student._index', [
                 'students' => Student::where('user_id', auth()->user()->id)->paginate(10),
            ]);
        }else{
            return view('livewire.student._index', [
                 'students' => Student::paginate(10),
            ]);
        }
    }

    public function store()
    {
        $this->validate();
        $student = new Student();
        $student->name = $this->name;
        $student->email = $this->email;
        $student->gender = $this->gender;
        $student->grade = $this->grade;
        $student->category = $this->category;
        $student->repeat = $this->repeat;
        $student->credits = $this->credits;
        $student->course_id = $this->course_id;
        $student->user_id = auth()->id();
        
        $student->save();

        session()->flash('message', 'Student created successfully.');

        $this->resetFields();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->showAddModal = true;
        $student = Student::findOrFail($id);

        $this->studentId = $student->id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->gender = $student->gender;
        $this->course_id = $student->course_id;
        $this->category = $student->category;
        $this->repeat = $student->repeat;
        $this->credits = $student->credits;
        $this->grade = $student->grade;
        //$this->updatedSelectedState($student->state);
        //$this->selectedCity = $student->city;
    }

    public function update()
    {
        $this->validate();
        $student = Student::find($this->studentId);
        $student->name = $this->name;
        $student->email = $this->email;
        $student->gender = $this->gender;
        $student->course_id = $this->course_id;
        $student->category = $this->category;
        $student->repeat = $this->repeat;
        $student->credits = $this->credits;
        $student->grade = $this->grade;
        $student->save();

        session()->flash('message', 'Student updated successfully.');
        $this->resetFields();
    }

    public function cancel()
    {
        $this->resetFields();
    }

    public function delete($id)
    {
        $this->studentIdToDelete = $id; 
        $this->confirmingDelete = true; 
    }

    private function resetFields()
    {
        $this->reset(['name', 'email','course_id', 'credits','grade', 'category', 'repeat']);
        $this->showAddModal = false;
        $this->updateMode = false;
    }

    public function confirmDelete()
    {
        if ($this->studentIdToDelete) {
            $student = Student::find($this->studentIdToDelete);
            if ($student) {
                $student->delete();
                session()->flash('message', 'Student deleted successfully.');
                $this->studentIdToDelete = null;
                $this->confirmingDelete = false;
            }
        }
    }

    public function showAdd()
    {
         $this->showAddModal = true;
    }
}