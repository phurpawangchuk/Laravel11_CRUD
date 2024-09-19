<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Student;

class StudentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

     public function update(User $user, Student $student)
    {
        return $user->id === $student->user_id;
    }

    public function delete(User $user, Student $student)
    {
        return $user->id === $student->user_id;
    }
}