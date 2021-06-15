<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\_CONST;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] == "Tên") {
            return null;
        }

        if($row[0] == null || $row[1] == null || $row[2] == null || $row[6] == null) {
            return null;
        }

        $user = new User();
        $user->name = $row[0];
        $user->email = $row[2];
        // define this user as a student
        $user->role_id = _CONST::STUDENT_ROLE_ID;
        $user->title = "";
        $user->theme = "danger";
        $user->password = bcrypt("student123");
        $user->save();

        $gender = 1;
        if($row[3] == "Nam") {
            $gender = 1;
        } elseif($row[3] == "Nữ") {
            $gender = 2;
        } elseif($row[3] == "Khác") {
            $gender = 3;
        }

        
        $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);

        //protected $fillable = ['user_id', 'name', 'phone', 'email', 'gender', 'dob', 'sYear', 'department_id', 'parent_school_id', 'address'];

        return new Student([
            'user_id' => $user->id,
            'name' => $row[0],
            'phone' => $row[1],
            'email' => $row[2],
            'gender' => $gender,
            'dob' => $dob,
            'sYear' => $row[5],
            'department_id' => $row[6],
            'parent_school_id' => $row[7],
            'address' => $row[8]
        ]);
    }
}
