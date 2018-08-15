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

@section('settings-manage-users')
  <table>
    <tr>
        <td><h6>Active Member/s</h6></td>
        <td><h6>Admin</h6></td>
        <td><h6>Delete</h6></td>
    </tr>
    @foreach($employees as $e)
    <tr>
      <td>{{ $e->name }}</td>
      @php
        $checked = $e->type === 'admin' ? 'checked' : '';
      @endphp
      <td>
        <label class="switch">
          <input class="admin-checkbox" type="checkbox" {{ $checked }}>
          <span class="slider round"></span>
        </label>
      </td>
      <td class="admin-delete-td">
        <i class="far fa-trash-alt admin-delete-icon"></i>
      </td>
    </tr>
    @endforeach
  </table>
@endsection
