@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-md-10 admin-welcome-box">
        <article class="message is-info justify-content-center">
          <div class="message-header">
            <p>Welcome, {{ Auth::user()->first_name }}</p>
          </div>

          @yield('admin-body')
        </article>
      </div>
    </div>
</div>
@endsection
