<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EnrollmentController extends Controller
{
    public function getEnrollments()
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

    //función para obtener una lista de matriculas por cuatro parámetros opcionales:carrera,curso,paralelo,periodo

    public function getEnrollmentsByParams(Request $request)
    {
        $params = $request->all();

        $query = Enrollment::query();

        foreach ($params as $param) {
            $column = $param['type'];
            if (!Schema::hasColumn('enrollments', $column)) {
                continue;
            }
            $query->where($column, 'like', '%' . $param['term'] . '%');
        }


        $enrollments = $query->get();

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


    //función para obtener una lista de matriculas por el value deltipo de matricula que es un catalogo
    public function getEnrollmentsByType($type)
    {
        $enrollments = Enrollment::whereHas('typeEnrollment', function ($query) use ($type) {
            $query->where('value',  $type);
        })->get();

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

    //función para obtener una lista de matriculas por termino de búsqueda
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
