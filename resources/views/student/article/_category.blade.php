@foreach($articles as $article)            
    <a class="blog-item" href="{{route('post',['categories'=>$article->category->slug, 'slug'=>$article->slug])}}">
        <figure class="image-holder">
            @if($article->image != '')
                <img alt="{{$article->title}}" title="" src="{{ asset($article->image)}}">
            @else
                <img alt="" title="" src="../../assets/img/blog-banner.jpg">
            @endif
        </figure>
        <div class="body">
            <div class="flex-grow-1 last-margin-0 pb-30">
                <h5 class="blog-title">{{$article->title}}</h5>
                <p>{!!\Illuminate\Support\Str::words(strip_tags($article->content), 15, '...')!!}</p>
            </div>
            <footer>
                <span>by {{ ($article->author) ? $article->author->name: null}}</span>
                <span>{{$article->date->format('m/d/Y')}}</span>
            </footer>
        </div>
    </a>
@endforeach