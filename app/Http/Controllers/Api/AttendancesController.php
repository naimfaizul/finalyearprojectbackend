<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance;

class AttendancesController extends Controller
{
    public function store(Request $request)
    {
        $this->validateAttendance();
        $attendance = new Attendance;
        $attendance->fill([
            'user_id' => Auth::id(),
            'location' => $request->location,
        ]);
        $attendance->save();

        return $attendance;
    }

    protected function validateAttendance()
    {
        return request()->validate([
            'location' => 'required',
        ]);
    }
}
