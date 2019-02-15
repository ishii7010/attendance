<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\Rest;
use App\WorkHour;
use Carbon\Carbon;

class WorksController extends Controller
{
    public function create()
    {
        $user = \Auth::user();

        if ( $user->status == 1 )
        {
            $work = $user->works->last();
        }

        if ($user->rest_status == 1)
        {
            $rest = $work->rest;
        }
        return view('work.create', compact('user', 'work', 'rest'));
    }

    public function store()
    {
        $user = \Auth::user();
        $work = new Work;
        $work->user_id = $user->id;
        $dt = Carbon::now();
        $work->start_time = $dt;
        $work->work_day = $dt->format('Y年m月d日');
        if ($work->save())
        {

            $user->status = 1;
            $user->rest_status = 0;
            $user->save();
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }

    public function update(Request $request, Work $work)
    {
        $user = \Auth::user();
        $work->end_time = Carbon::now();
        if ($work->save())
        {
            $dt1 = new Carbon($work -> start_time);
            $dt2 = new Carbon($work -> end_time);
            $work->work_time = $dt1->diffInHours($dt2);
            $work->save();
            //eval(\Psy\sh());
            $user->status = 0;
            $user->save();
            if ($work->rest->count() == 1)
            {
                $work_hour = new WorkHour;
                $work_hour->user_id = $user->id;
                $rest = $work->rest;
                $work_hour->work_hour = $work->work_time - $rest->rest_time;
                $work_hour->save();
            }
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }
}
