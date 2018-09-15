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
        <td>
        @foreach($votedVC as $vvc)
          @if(!$doneValueCreator && ($vvc->nominee === $vcVote->nominee))
            <button class="btn btn-dark btn-sm add-vote-vc">VOTE</button>
          @endif
        @endforeach
        </td>
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
        <td>
        @foreach($votedPD as $vpd)
          @if(!$donePeopleDeveloper && ($vpd->nominee == $pdVote->nominee))
            <button class="btn btn-dark btn-sm add-vote-pd">VOTE</button>
          @endif
        @endforeach
        </td>
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
        <td>
        @foreach($votedBO as $vbo)
          @if(!$doneBusinessOperator && ($vbo->nominee == $boVote->nominee))
            <button class="btn btn-dark btn-sm add-vote-bo">VOTE</button>
          @endif
        @endforeach
        </td>
      </tr>
      @endforeach
  </table>
@endsection
