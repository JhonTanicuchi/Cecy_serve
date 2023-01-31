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

    //funcion para obtener una lista de matriculas por cuatro parámetros opcionales:carrera,curso,paralelo,periodo

    public function getEnrollments($career = null, $course = null, $parallel = null,$working_day=null, $period = null)
    {
        $enrollments = Enrollment::where('career_id', 'like', '%' . $career . '%')
            ->where('course_id', 'like', '%' . $course . '%')
            ->where('parallel_id', 'like', '%' . $parallel . '%')
            ->where('working_day_id', 'like', '%' . $working_day . '%')
            ->where('period_id', 'like', '%' . $period . '%')
            ->get();

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

    //funcion para obtener una lista de matriculas por el tipo de matricula
    public function getEnrollmentsByType($type)
    {
        $enrollments = Enrollment::where('type_enrollment_id', 'like', '%' . $type . '%')
            ->get();

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

    //funcion para obtener una lista de matriculas por termino de búsqueda
    public function getEnrollmentsBySearch($term = null)
    {
        $enrollments = Enrollment::where('id', 'like', '%' . $term . '%')
            ->orWhereHas('student', function ($query) use ($term) {
                $query->whereHas('person', function ($query) use ($term) {
                    $query->where('names', 'like', '%' . $term . '%')
                        ->orWhere('last_names', 'like', '%' . $term . '%')
                        ->orWhere('identification', 'like', '%' . $term . '%');
                });
            })
            ->orWhereHas('career', function ($query) use ($term) {
                $query->where('name', 'like', '%' . $term . '%');
            })
            ->orWhereHas('course', function ($query) use ($term) {
                $query->where('name', 'like', '%' . $term . '%');
            })
            ->orWhereHas('state', function ($query) use ($term) {
                $query->where('value', 'like', '%' . $term . '%');
            })
            ->orWhereHas('typeEnrollment', function ($query) use ($term) {
                $query->where('value', 'like', '%' . $term . '%');
            })
            ->get();

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
