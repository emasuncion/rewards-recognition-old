@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Value Creator
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('result-value-creator')
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              People Developer
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('result-people-developer')
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Bussiness Operator
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('result-business-operator')
            </div>
          </div>
        </div>
      </div>
    </div> <!-- End of row -->
  </div> {{-- End of container --}}
@endsection
