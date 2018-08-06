@extends('admin.voters')

@section('already-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @foreach($voted as $v)
        <ul>
          <li>{{  $v->name }}</li>
        </ul>
      @endforeach
    </p>
  </div>
@endsection

@section('not-yet-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @foreach($notVotedYet as $v)
        <ul>
          <li>{{  $v->name }}</li>
        </ul>
      @endforeach
    </p>
  </div>
@endsection
