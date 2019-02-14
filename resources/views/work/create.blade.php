@extends('layouts.app')
@section('content')
 <div>
     @if ( $user->status == 0 )
        <form action="{{ url('work') }}" method="post">
            {{ csrf_field() }}
            <button type="submit" name="submit" class="btn btn-primary">{{ __('出勤') }}</button>
        </form>
     @else
     <form action="{{ url('work/'.$work->id) }}" method="POST">
         {{ csrf_field() }}
         @method('PUT')
         <button type="submit" name="submit" class="btn btn-danger">{{ __('退勤') }}</button>
     </form>
     @endif
 </div>
@endsection
