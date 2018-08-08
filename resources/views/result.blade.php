@extends('admin.result')

@section('result-value-creator')
  <table>
    @foreach($valueCreatorVotes as $vcVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-value-creator-{{ $vcVote->nominee }}');
            el.className+=' is-active'">{{ $vcVote->nominee }}</td>
      </tr>
      @include('modals.valueCreator', ['name' => $vcVote->nominee, 'explanations' => $valueCreatorExplanations])
    @endforeach
  </table>
@endsection

@section('result-people-developer')
  <table>
    @foreach($peopleDeveloperVotes as $pdVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-people-developer-{{ $pdVote->nominee }}');
            el.className+=' is-active'">{{ $pdVote->nominee }}</td>
      </tr>
      @include('modals.peopleDeveloper', ['name' => $pdVote->nominee, 'explanations' => $peopleDeveloperExplanations])
      @endforeach
  </table>
@endsection

@section('result-business-operator')
  <table>
    @foreach($businessOperatorVotes as $boVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-business-operator-{{ $boVote->nominee }}');
            el.className+=' is-active'">{{ $boVote->nominee }}</td>
      </tr>
      @include('modals.businessOperator', ['name' => $boVote->nominee, 'explanations' => $businessOperatorExplanations])
      @endforeach
  </table>
@endsection
