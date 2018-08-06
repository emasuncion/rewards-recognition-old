@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col align-self-center admin-welcome-box">
      <article class="message is-info justify-content-center">
        <div class="message-header">
          <p>Welcome {{ Auth::user()->name }}</p>
        </div>

        @yield('admin-body')
      </article>
    </div>
</div>
@endsection
