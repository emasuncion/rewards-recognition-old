@extends('admin.result')

@section('result-value-creator')
  <table>
    @foreach($valueCreatorNominations as $vcVote)
    @php
      $shortName = preg_replace('/ /', '', $vcVote->nominee);
    @endphp
      <tr class="nominees">
        <td data-toggle="collapse" href="#vc{{ $shortName }}" role="button" aria-expanded="false" aria-controls="vc{{ $shortName }}"><i class="fas fa-caret-down"></i><i class="fas fa-caret-up" style="display: none;"></i> {{ $vcVote->nominee }}
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
                @foreach($peopleDeveloperNominations as $pde)
                  @if($pde->nominee === $pdVote->nominee)
                    <li>{{ $pde->explanation }}</li>
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        <td>{{ $pdVote->vote }}</td>
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
                @foreach($businessOperatorNominations as $boe)
                  @if($boe->nominee === $boVote->nominee)
                    <li>{{ $boe->explanation }}</li>
                  @endif
                @endforeach
              </ul>
            </div>
        </td>
        <td>{{ $boVote->vote }}</td>
      </tr>
      @endforeach
  </table>
@endsection
