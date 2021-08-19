<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attendance;
use App\Forum;
use App\User;
use App\Topic;
use App\Question;
use App\Test;
use App\TestAnswer;
use App\QuestionsOption;

class MiscController extends Controller
{

    public function attendance(Request $request)
    {
        // $this->validateAttendance();
        $user = User::where('email', $request->get('email'))->first();
        $attendance = new Attendance;
        $attendance->fill([
            'user_id' => $user->id,
            'location' => $request->get('location'),
        ]);
        $attendance->save();

        $json = [
            'success' => true,
            'error' => [
                'code' => "200",
                'message' => "Attendance recorded!",
            ],
        ];
        return response()->json($json, 200);
    }

    public function forum(Request $request)
    {
        $forum = new Forum;
        $forum->fill([
            'question' => $request->get('question'),
        ]);
        $forum->save();

        $json = [
            'success' => true,
            'error' => [
                'code' => "200",
                'message' => "Question sent!",
            ],
        ];
        return response()->json($json, 200);
    }

    public function topics()
    {
        return json_encode(Topic::all());
    }

    public function questions()
    {
        return json_encode(Question::with('options')->get());
    }

    public function quiz(Request $request)
    {

        $user = User::where('email', $request->get('email'))->first();
        $result = 0;

        $test = Test::create([
            'user_id' => $user->id,
            'result'  => $result,
        ]);

        $answers = json_decode($request->get('answers'));
        
        $q = 0;
        foreach ($answers as $answer){
            $arr = explode(",", $answer);
            $question = $arr[0];
            $answer = $arr[1];

            $status = 0;

            if ($answer != "0"
                && QuestionsOption::find($answer)->correct
            ) {
                $status = 1;
                $result++;
            }
            TestAnswer::create([
                'user_id'     => $user->id,
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $answer,
                'correct'     => $status,
            ]);
            $q += 1;
        }

        $test->update(['result' => $result]);

        return response()->json("$result of $q", 200);
    }

    public function result(Request $request){
        $user = User::where('email', $request->get('email'))->first();
        $test = Test::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        $answer = TestAnswer::where('test_id', $test->id)->get()->count();

        return response()->json("$test->result of $answer", 200);
    }

}
