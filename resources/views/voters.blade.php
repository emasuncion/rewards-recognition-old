@extends('admin.voters')

@section('already-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @if(count($voted) > 0)
        @foreach($voted as $v)
          <ul>
            <li>{{  $v->first_name }}</li>
          </ul>
        @endforeach
      @else
        <p>Aww, it seems that no one has voted yet.</p>
      @endif
    </p>
  </div>
@endsection

@section('not-yet-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @if(count($notVoted) > 0)
        @foreach($notVoted as $v)
          <ul>
            <li>{{  $v->first_name }}</li>
          </ul>
        @endforeach
      @else
        <p>Hooorah! Everybody in the team already voted.</p>
      @endif
    </p>
  </div>
@endsection
