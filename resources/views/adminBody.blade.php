@extends('admin.admin')

@section('admin-body')
    <div class="message-body col-sm-12 col-md-12">
      <h1 class="mb-2 font-weight-bold">What is Rewards vs. Recognition (R&R)</h1>
      <div class="body">
        <p class="mb-2">
          <strong>Rewards</strong> are items such as: gift cards, cash, or perks such as time off or discounts earned through receiving recognition or achieving your goals within an incentive program while <strong>Recognition</strong> is a discretionary act to recognize something great that might come in the form of a social posting, an e-card, a physical note or greeting card, a verbal "thank you," etc.
        </p>

        <p class="mt-2">
          Rewards is also called Monetary award while Recognition is not.
        </p>

        <p class="mt-2">
          In the Education platform, both Rewards and Recognition are practiced as one a means to promote people engagement and appreciation to one's contribution to the group.
        </p>
      </div>
    </div>

    <div class="row justify-content-center">
      @php
        $tools = auth()->user()->nominationOpen() ? ['Voters', 'Nominations', 'Graph'] : ['Voters', 'Results', 'Graph'];
      @endphp
      @include('layouts.adminTools', compact('tools'))
    </div>
@endsection
