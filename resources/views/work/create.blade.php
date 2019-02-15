
<link href="{{ asset('css/work/work.css') }}" rel="stylesheet">
<script src="{{ asset("js/work/work.js") }}"></script>
@extends('layouts.app')

@section('content')

<div id="clock">
    <div id="clock_frame">
        <div id="clock_date">
        </div>
        <div id="clock_time">
        </div>
    </div>

    <div class="menu clearfix">
         @if ( $user->status == 0 )
            <form action="{{ url('work') }}" method="post">
                {{ csrf_field() }}
                <div class="button-posi"><button type="submit" name="submit" class="button1">{{ __('出勤') }}</button></div>
            </form>
         @else
             <form action="{{ url('work/'.$work->id) }}" method="POST">
                 {{ csrf_field() }}
                 @method('PUT')
                 <div class="button-posi"><button type="submit" name="submit" class="button2">{{ __('退勤') }}</button></div>
             </form>

             @if ($user->rest_status == 0)
                <form action="{{ url('rest') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" name="submit" class="butto">{{ __('休憩') }}</button>
                </form>
             @elseif ($user->rest_status == 1)
                <form action="{{ url('rest/'.$rest->id) }}" method="POST">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="button-posi"><button type="submit" name="submit" class="but">{{ __('終了') }}</button></div>
                </form>
             @else
             @endif
         @endif

         <button class="user-show clearfix"><a href="{{ url('user/'.$user->id) }}">{{ "勤怠" }}</a></button>
     </div>
</div>
@endsection
