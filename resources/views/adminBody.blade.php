@extends('admin.admin')

@section('admin-body')
    <div class="message-body">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin congue lorem sed mattis luctus. Nulla felis mauris, auctor eget eleifend sed, blandit a enim. Donec consequat nisl diam. Fusce tincidunt dolor dictum odio malesuada lobortis. Vivamus felis elit, scelerisque a ornare ac, efficitur sit amet est. Sed gravida metus vitae dolor ultrices, quis sodales lacus maximus. Nulla facilisi. Sed sagittis congue gravida. Nam tincidunt odio dui, sed placerat mi pretium ac.</p>

      <p>
        Aliquam at finibus odio. Aliquam pretium sagittis felis eu vestibulum. Fusce diam diam, venenatis ac pulvinar at, ultrices id felis. Aenean id est pharetra, finibus neque in, pretium purus. Curabitur fermentum vulputate metus vel semper. Nunc vel ex vehicula, eleifend est non, molestie justo. Etiam facilisis libero et massa porttitor, at elementum sapien tempor. Cras cursus mollis arcu sit amet tempor. Maecenas vel mi sem. Integer nisi magna, ultrices sed libero ut, iaculis blandit dui.
      </p>
    </div>

    <div class="row">
      @include('layouts.adminTools', ['tools' => ['Voters', 'Results', 'Graph']]);
    </div>
@endsection
