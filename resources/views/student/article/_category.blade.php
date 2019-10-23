@foreach($articles as $article)
    <a href="{{route('post',['categories'=>$article->category->slug, 'slug'=>$article->slug])}}">
        <li>
            <div class="ho-ev-date pg-eve-date">
                <span>{{ $article->date->format('d') }}</span><span>{{ $article->date->format('M') }}, 20{{ $article->date->format('y') }}</span>
            </div>
            <div class="s17-eve-time-msg">
                <h4>{{ $article->title }}</h4>
                <p>{!!\Illuminate\Support\Str::words(strip_tags($article->content), 15, '...')!!}</p>
            </div>
        </li>
    </a>
@endforeach
