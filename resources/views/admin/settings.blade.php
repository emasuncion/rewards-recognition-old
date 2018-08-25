@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row mb-4">
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
              Reset Votes
            </p>
          </header>
          <div class="card-content">
            <div class="content admin-settings-body">
              @yield('settings-reset-voters')
            </div>
          </div>
        </div>
      </div>
    </div> <!-- End of row -->
    <div class="row justify-content-center mb-4">
      <div class="col-md-6">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Manage User Profiles (no delete yet)
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('settings-manage-users')
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title is-centered">
              Add a member/account
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              @yield('settings-add-member')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> {{-- End of container --}}
@endsection
