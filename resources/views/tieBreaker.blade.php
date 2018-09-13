@extends('admin.tieBreaker')

@section('tie-value-creator')
  <table>
    @if($valueCreatorTie)
      @foreach($valueCreatorTie as $vcVote)
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
          <td>{{ $vcVote->count }}</td>
          @if(count($valueCreatorTie) > 1)
            <td><button class="btn btn-dark btn-sm add-vote-vc">VOTE</button></td>
          @endif
        </tr>
      @endforeach
    @else
      <tr>
        <td>None</td>
      </tr>
    @endif
  </table>
@endsection

@section('tie-people-developer')
  <table>
    @if($peopleDeveloperTie)
      @foreach($peopleDeveloperTie as $pdVote)
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
          <td>{{ $pdVote->count }}</td>
          @if(count($peopleDeveloperTie) > 1)
            <td><button class="btn btn-dark btn-sm add-vote-pd">VOTE</button></td>
          @endif
        </tr>
        @endforeach
      @else
        <tr>
          <td>None</td>
        </tr>
      @endif
  </table>
@endsection

@section('tie-business-operator')
  <table>
    @if($businessOperatorTie)
      @foreach($businessOperatorTie as $boVote)
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
          <td>{{ $boVote->count }}</td>
          @if(count($businessOperatorTie) > 1)
            <td><button class="btn btn-dark btn-sm add-vote-bo">VOTE</button></td>
          @endif
        </tr>
        @endforeach
      @else
        <tr>
          <td>None</td>
        </tr>
      @endif
  </table>
@endsection
