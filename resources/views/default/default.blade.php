@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 admin-welcome-box">
        <article class="message is-info justify-content-center">
          <div class="message-header">
            <p>Welcome, {{ auth()->user()->first_name }}</p>
          </div>

          @yield('default-body')
        </article>
      </div>
    </div>
</div>
@endsection
