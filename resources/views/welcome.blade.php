
@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php $user = Auth::user(); 
        $count_microposts = $user->feed_microposts()->count();
        $count_favaritings = $user->favaritings->count();
        ?>
        <div class="row">
            <aside class="col-xs-4">
                {!! Form::open(['route' => 'microposts.store']) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '5']) !!}
                    </div>
                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </aside>
            <div class="col-xs-8">
                @if (count($microposts) > 0)
                    <ul class="nav nav-tabs nav-justified" style="margin-bottom: 20px">
                      <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Microposts <span class="badge">{{ $count_microposts }}</span></a></li>
                      <li class="{{ Request::is('favarite') ? 'active' : '' }}"><a href="/favarite">FavaritMessages <span class="badge">{{ $count_favaritings }}</span></a></li>

                    </ul>                  
                    @include('microposts.microposts', ['microposts' => $microposts])
                @endif
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection