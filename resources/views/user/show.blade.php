@extends('layouts.app')

@section('content')

<table border="1">
    <thead>
        <tr>
            <th>勤務開始時間</th>
            <th>勤務終了時間</th>
            <th>労働時間</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
    </thead>
    @foreach ($works AS $work)
    <tbody>
        <tr>
            <td class="start_work">{{ $work->start_time }}</td>
            <td class="end_work">{{ $work->end_time }}</td>
            <td class="work_time">{{ $work->work_time }}分</td>
            <td class="rest_time">{{ $work->work_hour }}分</td>
            <td class="work_hour">{{ $work->work_hour }}分</td>
        </tr>
    </tbody>
    @endforeach
</table>

<div class="btn btn-danger"><a href="{{ url('work/create') }}">{{ "打刻" }}</a></div>
@endsection
