@extends('default.awardForward')

@section('award-forward-td')
  <div>
    <span class="float-right award-forward-add-cursor">
      <i class="fa fa-plus mb-4 award-forward-add">Add</i>
    </span>
  </div>
  <table id="award-forward-table" class="table table-striped table-bordered nowrap">
    <tr>
      <td>Name</td>
      <td>Description</td>
      <td>Date</td>
    </tr>
    @foreach($nominees as $nominee)
      <tr>
        <td>{{ $nominee->nominee }}</td>
        <td>{{ $nominee->description }}</td>
        <td>{{ $nominee->created_at->format('M-d-Y') }}</td>
      </tr>
    @endforeach
  </table>
  <div class="row justify-content-center">
    <div class="col-md-4">
      {{ $nominees->links() }}
    </div>
  </div>
  @include('modals.awardForward', compact('users'))
@endsection
