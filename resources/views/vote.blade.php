@extends('default.result')

@section('result-value-creator')
  <table>
    @foreach($valueCreatorNominations as $vcVote)
    @php
      $shortName = preg_replace('/ /', '', $vcVote->nominee);
    @endphp
      <tr class="nominees">
        <td data-id="{{ $vcVote->nominee }}" data-toggle="collapse" href="#vc{{ $shortName }}" role="button" aria-expanded="false" aria-controls="vc{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $vcVote->nominee }}
          <div class="collapse" id="vc{{ $shortName }}">
            <div class="card card-body">
              <ul>
                @foreach($valueCreatorExplanations as $vcEx)
                  @if($vcEx->nomination_id === $vcVote->id)
                    <li>{{ $vcEx->explanation }}</li>
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        <td>{{ $vcVote->vote }}</td>
        @if(count($doneValueCreator) < 1)
          <td><i class="fa fa-plus add-vote-vc"></i></td>
        @endif
      </tr>
    @endforeach
  </table>
@endsection

@section('result-people-developer')
  <table>
    @foreach($peopleDeveloperNominations as $pdVote)
    @php
      $shortName = preg_replace('/ /', '', $pdVote->nominee);
    @endphp
      <tr class="nominees">
        <td data-toggle="collapse" href="#pd{{ $shortName }}" role="button" aria-expanded="false" aria-controls="pd{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $pdVote->nominee }}
          <div class="collapse" id="pd{{ $shortName }}">
            <div class="card card-body">
              <ul>
                @foreach($peopleDeveloperExplanations as $pdEx)
                  @if($pdEx->nomination_id === $pdVote->id)
                    <li>{{ $pdEx->explanation }}</li>
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        <td>{{ $pdVote->vote }}</td>
        @if(count($donePeopleDeveloper) < 1)
          <td><i class="fa fa-plus add-vote-pd"></i></td>
        @endif
      </tr>
      @endforeach
  </table>
@endsection

@section('result-business-operator')
  <table>
    @foreach($businessOperatorNominations as $boVote)
    @php
      $shortName = preg_replace('/ /', '', $boVote->nominee);
    @endphp
      <tr class="nominees">
        <td data-toggle="collapse" href="#bo{{ $shortName }}" role="button" aria-expanded="false" aria-controls="bo{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $boVote->nominee }}
          <div class="collapse" id="bo{{ $shortName }}">
            <div class="card card-body">
              <ul>
                @foreach($businessOperatorExplanations as $boEx)
                  @if($boEx->nomination_id === $boVote->id)
                    <li>{{ $boEx->explanation }}</li>
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        <td>{{ $boVote->vote }}</td>
        @if(count($doneBusinessOperator) < 1)
          <td><i class="fa fa-plus add-vote-bo"></i></td>
        @endif
      </tr>
      @endforeach
  </table>
@endsection
