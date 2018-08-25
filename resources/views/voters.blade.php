@extends('admin.voters')

@section('already-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @if(isset($voted))
        @foreach($voted as $v)
          <ul>
            <li>{{  $v->first_name }}</li>
          </ul>
        @endforeach
      @else
        <p>No users voted.</p>
      @endif
    </p>
  </div>
@endsection

@section('not-yet-voted-body')
  <div class="col-md-12">
    <p class="welcome-message">
      @foreach($notVoted as $v)
        <ul>
          <li>{{  $v->first_name }}</li>
        </ul>
      @endforeach
    </p>
  </div>
@endsection
