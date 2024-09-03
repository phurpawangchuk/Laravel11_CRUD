<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Student;
use App\Models\User;

class WelcomeController extends Controller
{
    public $search = '';
    public function welcome()
    {
        $products = Product::all();
        $students = Student::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        $users = User::all();
        return view('welcome', compact('users','products','students'));
    }
}