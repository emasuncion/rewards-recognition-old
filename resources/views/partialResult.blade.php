@extends('default.result')

@section('result-value-creator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($valueCreatorVotes as $key => $vcVote)
      <tr>
        <td>{{ "Teammate $char[$key]" }}</td>
        <td>{{ $vcVote->vote }}</td>
      </tr>
    @endforeach
  </table>
@endsection

@section('result-people-developer')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($peopleDeveloperVotes as $key => $pdVote)
      <tr>
        <td>{{ "Teammate $char[$key]" }}</td>
        <td>{{ $pdVote->vote }}</td>
      </tr>
      @endforeach
  </table>
@endsection

@section('result-business-operator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($businessOperatorVotes as $key => $boVote)
      <tr>
        <td>{{ "Teammate $char[$key]" }}</td>
        <td>{{ $boVote->vote }}</td>
      </tr>
      @endforeach
  </table>
@endsection
