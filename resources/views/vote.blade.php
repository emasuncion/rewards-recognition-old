@extends('default.result')

@section('result-value-creator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($valueCreatorNominations as $key => $vcVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-value-creator-{{ $vcVote->nominee }}');
            el.className+=' is-active'">{{ $vcVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-vc"></i></td>
      </tr>
      @include('modals.valueCreator', ['name' => $vcVote->nominee, 'explanations' => $valueCreatorNominations])
    @endforeach
  </table>
@endsection

@section('result-people-developer')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($peopleDeveloperNominations as $key => $pdVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-people-developer-{{ $pdVote->nominee }}');
            el.className+=' is-active'">{{ $pdVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-pd"></i></td>
      </tr>
      @include('modals.peopleDeveloper', ['name' => $pdVote->nominee, 'explanations' => $peopleDeveloperNominations])
      @endforeach
  </table>
@endsection

@section('result-business-operator')
  <table>
    @php
      $char = range('A', 'Z');
    @endphp
    @foreach($businessOperatorNominations as $key => $boVote)
      <tr class="nominees">
        <td onclick="var el=document.getElementById('modal-business-operator-{{ $boVote->nominee }}');
            el.className+=' is-active'">{{ $boVote->nominee }}</td>
        <td><i class="fas fa-plus add-vote-bo"></i></td>
      </tr>
      @include('modals.businessOperator', ['name' => $boVote->nominee, 'explanations' => $businessOperatorNominations])
      @endforeach
  </table>
@endsection
