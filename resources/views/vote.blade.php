@extends('layouts.app')

@section('content')
  <div class="container">
    <form method="POST" action="/vote">
      @csrf
      <div class="card vote-value-creator-card">
        <header class="card-header">
          <p class="card-header-title">
            Value Creator
          </p>
        </header>
        <div class="card-content">
          @include('layouts.voteBody', ['employees' => $employees, 'position' => 'Value Creator', 'shorthand' => 'value_creator'])
        </div>
      </div>

      <div class="card vote-people-developer-card">
        <header class="card-header">
          <p class="card-header-title">
            People Developer
          </p>
        </header>
        <div class="card-content">
          @include('layouts.voteBody', ['employees' => $employees, 'position' => 'People Developer', 'shorthand' => 'people_developer'])
        </div>
      </div>

      <div class="card vote-business-opeartor-card">
        <header class="card-header">
          <p class="card-header-title">
            Business Operator
          </p>
        </header>
        <div class="card-content">
          @include('layouts.voteBody', ['employees' => $employees, 'position' => 'Business Operator', 'shorthand' => 'business_operator'])
        </div>
      </div>
      @if (count($errors) > 0)
        <div class="container">
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li class="vote-errors">{{ $error }}</li>
               @endforeach
            </ul>
         </div>
       </div>
      @endif
      <button class="button is-info is-rounded is-pulled-right submit-vote-button">Submit</button>
    </form>
  </div>
@endsection
