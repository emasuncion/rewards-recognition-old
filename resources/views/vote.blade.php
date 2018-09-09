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
                @foreach($valueCreatorExplanations as $key => $vcEx)
                  @if($key === $vcVote->nominee)
                    @foreach($vcEx as $v)
                      <li>{{ $v }}</li>
                    @endforeach
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        {{-- <td>{{ $vcVote->vote }}</td> --}}
        @if(count($doneValueCreator) < 1)
          <td><button class="btn btn-dark btn-sm add-vote-vc">VOTE</button></td>
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
        <td data-id="{{ $pdVote->nominee }}" data-toggle="collapse" href="#pd{{ $shortName }}" role="button" aria-expanded="false" aria-controls="pd{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $pdVote->nominee }}
          <div class="collapse" id="pd{{ $shortName }}">
            <div class="card card-body">
              <ul>
                @foreach($peopleDeveloperExplanations as $key => $pdEx)
                  @if($key === $pdVote->nominee)
                    @foreach($pdEx as $p)
                      <li>{{ $p }}</li>
                    @endforeach
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        {{-- <td>{{ $pdVote->vote }}</td> --}}
        @if(count($donePeopleDeveloper) < 1)
          <td><button class="btn btn-dark btn-sm add-vote-pd">VOTE</button></td>
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
        <td data-id="{{ $boVote->nominee }}" data-toggle="collapse" href="#bo{{ $shortName }}" role="button" aria-expanded="false" aria-controls="bo{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $boVote->nominee }}
          <div class="collapse" id="bo{{ $shortName }}">
            <div class="card card-body">
              <ul>
                @foreach($businessOperatorExplanations as $key => $boEx)
                  @if($key === $boVote->nominee)
                    @foreach($boEx as $b)
                      <li>{{ $b }}</li>
                    @endforeach
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        {{-- <td>{{ $boVote->vote }}</td> --}}
        @if(count($doneBusinessOperator) < 1)
          <td><button class="btn btn-dark btn-sm add-vote-bo">VOTE</button></td>
        @endif
      </tr>
      @endforeach
  </table>
@endsection
