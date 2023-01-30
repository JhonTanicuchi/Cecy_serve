<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {

        $enrollments = Enrollment::all();
        //popular el objeto student
        foreach ($enrollments as $enrollment) {
            $enrollment->student_id = $enrollment->student;
            //popular el objeto person
            $enrollment->student_id->person_id = $enrollment->student_id->person;
            //popular el objeto career
            $enrollment->career_id = $enrollment->career;
            //popular el objeto course
            $enrollment->course_id = $enrollment->course;
            //popular el objeto state
            $enrollment->state_id = $enrollment->state;
            //popular el objeto type_enrollment
            $enrollment->type_enrollment_id = $enrollment->typeEnrollment;
        }



        return response()->json([
            'status' => 'success',
            'data' => [
                'enrollments' => $enrollments
            ]
        ], 200);
    }
}
