<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forum;

class ForumController extends Controller
{
    public function store(Request $request)
    {
        $this->validateForum();
        $forum = new Forum;
        $forum->fill([
            'question' => $request->question,
        ]);
        $forum->save();

        return $forum;
    }


    protected function validateForum()
    {
        return request()->validate([
            'question' => 'required',
        ]);
    }
}
