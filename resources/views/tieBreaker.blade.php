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
                  @foreach($valueCreatorExplanations as $vcEx)
                    @if($vcEx->nomination_id === $vcVote->id)
                      <li>{{ $vcEx->explanation }}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
          </td>
          <td>{{ $vcVote->count }}</td>
          @if(count($valueCreatorTie) > 1)
            <td><i class="fa fa-plus add-vote-vc"></i></td>
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
                  @foreach($peopleDeveloperExplanations as $pdEx)
                    @if($pdEx->nomination_id === $pdVote->id)
                      <li>{{ $pdEx->explanation }}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
          </td>
          <td>{{ $pdVote->count }}</td>
          @if(count($peopleDeveloperTie) > 1)
            <td><i class="fa fa-plus add-vote-pd"></i></td>
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
                  @foreach($businessOperatorExplanations as $boEx)
                    @if($boEx->nomination_id === $boVote->id)
                      <li>{{ $boEx->explanation }}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
          </td>
          <td>{{ $boVote->count }}</td>
          @if(count($businessOperatorTie) > 1)
            <td><i class="fa fa-plus add-vote-bo"></i></td>
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
