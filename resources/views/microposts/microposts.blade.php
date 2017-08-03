<ul class="media-list">
 
    
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    <li class="media">
        <div  style="border-bottom:  1px dotted #c0c0c0; padding-bottom: 10px">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
 
            </div>
            <div>
                <p>{!! nl2br(e($micropost->content)) !!}</p>
            </div>
            <div style="width: 200px">
               @if ( $micropost->is_favariting(Auth::user()->id) )
         {{--       <button type="button" class="btn btn-warning btn-xs pull-right">お気に入りから削除</button> --}}


                    {!! Form::open(['route' => ['user.unfavarite', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('お気に入りから削除', ['class' => 'btn btn-warning btn-xs pull-right']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['user.favorite', $micropost->id], 'method' => 'post']) !!}
                        {!! Form::submit('お気に入りに追加', ['class' => 'btn btn-success btn-xs pull-right']) !!}
                    {!! Form::close() !!}
               @endif
                @if (Auth::user()->id == $micropost->user_id)
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif

            </div>
        </div>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}
