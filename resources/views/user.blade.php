@extends("layout.main")

@section('content')
    <div class="container">
        <div class="centered centered--col min-vh-100">
            <user user-name="{{$display_name}}"
                  @if(!empty($images))
                  img-url="{{(array_pop($images))->url}}"
                    @endif></user>
            <user-playback user-id="{{session('user')}}" user-plan="{{$product}}"></user-playback>
            <a href="/user/logout" class="btn btn-sm spotify-btn spotify-btn--white mt-5">Logout</a>
        </div>
    </div>
@endsection
