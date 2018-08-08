@extends('admin.settings')

@section('settings-voting')
  @php
    $value = auth()->user()->votingOpen() ? 'open': 'closed';
  @endphp
  <span class="voting-status-text">Voting is currently {{ $value }}</span>
  <a class="button is-success is-rounded" href="/" onclick="event.preventDefault();
    var el = document.getElementById('modal-settings-vote');
    el.className += ' is-active'">
    Change
  </a>
  @include('modals.voting')
@endsection

@section('settings-reset-voters')
  <a class="button is-danger is-rounded" href="/" onclick="event.preventDefault();
    var el = document.getElementById('modal-settings-reset');
    el.className += ' is-active'">
    Reset all votes
  </a>
  @include('modals.reset')
@endsection
