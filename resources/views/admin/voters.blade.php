@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col align-self-center admin-welcome-box">
        <article class="message is-info justify-content-center">
          <div class="message-header">
            <p>People who already voted</p>
          </div>
          @yield('already-voted-body')
        </article>
      </div>

      <div class="col align-self-center admin-welcome-box">
        <article class="message is-info justify-content-center">
          <div class="message-header">
            <p>People who did not vote</p>
          </div>
          @yield('not-yet-voted-body')
        </article>
      </div>
    </div>
  </div>
@endsection
