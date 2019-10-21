@extends('...layouts.app')
@section('title', Config::get('settings.meta_title').' - '.$article->title)
@section('content')

<link href="{{ URL::asset('assets/css/social-buttons.css') }}" rel="stylesheet" />
@section('page_level_js')
    <script type="text/javascript" src="{{ URL::asset('assets/js/social-buttons.js?date=may16') }}"></script>
    <script>
        $(function () {
            $('[data-social]').socialButtons({
                url: "{{route('post',['categories'=>$article->category->slug, 'slug'=>$article->slug])}}"
            });
        });
    </script>
@stop

<div class="blog-feature-image">
    @if($article->image != '')
        <img alt="" title="" src="{{asset($article->image)}}" class="base-image">
    @else
        <img alt="" title="" src="../../assets/img/blog-banner.jpg" class="base-image">
    @endif
    <div class="caption">
        <h2>{{$article->title}}</h2>
        <small>{{ ($article->author) ? $article->author->name.'/': null}} {{$article->date->format('F d, Y')}}</small>
    </div>
</div>
<main class="blog-wrapper">
    <div class="container">
        <div class="blog-details">
            <div class="last-margin-0 mb-30">
                {!! $article->content !!}
            </div>
            <div class="share-holder">
                <div class="social">
                    <div class="social__item">
                        <span class="fa fa-facebook" data-count="..." data-social="fb"></span>
                    </div>
                    <div class="social__item">
                        <span class="fa fa-twitter" data-count="..." data-social="tw"></span>
                    </div>
                    <div class="social__item">
                        <span class="fa fa-instagram" data-count="..." data-social="instagram"></span>
                    </div>
                    <div class="social__item">
                        <span class="fa fa-youtube" data-count="..." data-social="youtube"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-posts pt-50">
            <a href="{{route('category', ['categories'=>$article->category->slug])}}" class="btn btn-default">BACK TO MAIN PAGE</a>
        </div>
    </div>
</main>
@stop
