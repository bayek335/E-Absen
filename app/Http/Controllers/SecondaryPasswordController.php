<?php

namespace App\Http\Controllers;

use App\Models\SecondaryPassword;

class SecondaryPasswordController extends Controller
{
    public function showPassword(SecondaryPassword $secondaryPassword)
    {
        $password = SecondaryPassword::where('student_id', $secondaryPassword->student_id)->get('secondary_password')->first();
        return response()->json([
            'status' => 'success',
            'data' => $password
        ]);
    }
}
