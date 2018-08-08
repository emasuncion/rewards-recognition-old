@extends('default.result')

@section('result-value-creator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($valueCreatorVotes as $key => $vcVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-value-creator-{{ $vcVote->nominee }}');
            el.className+=' is-active'">{{ $vcVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-vc"></i></td>
      </tr>
      @include('modals.valueCreator', ['name' => $vcVote->nominee, 'explanations' => $valueCreatorExplanations])
    @endforeach
  </table>
@endsection

@section('result-people-developer')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($peopleDeveloperVotes as $key => $pdVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-people-developer-{{ $pdVote->nominee }}');
            el.className+=' is-active'">{{ $pdVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-pd"></i></td>
      </tr>
      @include('modals.peopleDeveloper', ['name' => $pdVote->nominee, 'explanations' => $peopleDeveloperExplanations])
      @endforeach
  </table>
@endsection

@section('result-business-operator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($businessOperatorVotes as $key => $boVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-business-operator-{{ $boVote->nominee }}');
            el.className+=' is-active'">{{ $boVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-bo"></i></td>
      </tr>
      @include('modals.businessOperator', ['name' => $boVote->nominee, 'explanations' => $businessOperatorExplanations])
      @endforeach
  </table>
@endsection
