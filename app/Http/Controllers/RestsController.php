<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rest;
use App\Work;
use Carbon\Carbon;

class RestsController extends Controller
{
    public function store()
    {
        $user = \Auth::user();
        $rest = new Rest;
        $rest->user_id = $user->id;
        $work = $user->works->last();
        $rest->work_id = $work->id;
        $dt = Carbon::now();
        $rest->rest_start = $dt;
        if ($rest->save())
        {
            $user->rest_status = 1;
            $user->save();
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }

    public function update(Request $request, Rest $rest)
    {
        $user = \Auth::user();
        $rest->rest_end = Carbon::now();
        if ($rest->save())
        {
            $dt1 = new Carbon($rest -> rest_start);
            $dt2 = new Carbon($rest -> rest_end);
            $rest->rest_time = $dt1->diffInHours($dt2);
            $rest->save();
            //eval(\Psy\sh());
            $user->rest_status = 2;
            $user->save();
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }
}
