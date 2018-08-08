@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Voting
            </p>
          </header>
          <div class="card-content">
            <div class="content admin-settings-body">
              @yield('settings-voting')
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Reset Voters
            </p>
          </header>
          <div class="card-content">
            <div class="content admin-settings-body">
              @yield('settings-reset-voters')
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="col">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Clean Data
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('settings-clean-data')
            </div>
          </div>
        </div>
      </div> --}}
    </div> <!-- End of row -->
  </div> {{-- End of container --}}
@endsection
