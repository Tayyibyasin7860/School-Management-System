@extends('...layouts.app')
@section('title', Config::get('settings.meta_title').' - '.$category->name)
@section('content')

<div class="blog-recent-post">
    <div class="container">
        <h2 class="blog-title">Welcome To Our Blog</h2>
        <p>A Powerful Yet Usable All-In-One Platform Made For People.</p>
    </div>
</div>

<nav class="blog-nav">
    <div class="container">
        <div class="col-sm-4 col-sm-offset-4">
            <select class="form-control" id="blog_cat_dd">

                @foreach(\App\Models\Category::all() as $_category)
                    <option value="{{$_category->slug}}" {{ (request()->route('categories') == $_category->slug)?'selected':'' }} >{{$_category->name}}</option>
                    <!-- <a href="{{route('category', ['categories'=>$_category->slug])}}" class="{{ (request()->route('categories') == $_category->slug)?'active':'' }}">{{$_category->name}}</a> -->
                @endforeach
            </select>
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>
</nav>

<main class="blog-wrapper">
    <div class="container">
        @if(count($articles)>0)

        @endif
        @if(count($articles)>0)
            @include('student.article._category', [
                'articles'=>$articles
            ])
        <!-- <div class="more-posts">
            <a href="#" class="btn btn-default load-more">Load more</a>
        </div> -->
        @else
            <div class="mb-0 alert alert-warning text-center">No more data available123.</div>
        @endif
            @if(count($articles)>0)
            <div class="load-more" lastID="{{ $articles->last()->id }}" align="center" style="display: none;">
            <img src="{{ URL::asset('assets/img/ajax-loader.gif') }}"/>

        </div>
            @endif
    </div>
</main>
@stop

@section('page_level_js')
<script>
jQuery(document).ready(function(){

    {{--var page = 1;--}}
    {{--// Load more data--}}
    {{--//jQuery'.load-more').click(function(e){--}}
    {{--jQuerywindow).scroll(function(e){--}}
    {{--    //e.preventDefault();--}}
    {{--    var lastID = jQuery('.load-more').attr('lastID');--}}
    {{--    //alert(lastID);--}}
    {{--    if((jQuerywindow).scrollTop() == jQuery(document).height() - jQuery(window).height()) && (lastID != 0 )){ // alert('in');--}}
    {{--        page+=1;--}}

    {{--        $.ajax({--}}
    {{--            url: '{{route('category', ['name'=>$category->slug])}}',--}}
    {{--            type: 'post',--}}
    {{--            data: {page:page},--}}
    {{--            beforeSend:function(){--}}
    {{--               jQuery('.load-more').show();--}}
    {{--            },--}}
    {{--            success: function(response){--}}
    {{--                console.log(response);--}}
    {{--                if(response){--}}
    {{--                    // Setting little delay while displaying new content--}}
    {{--                    setTimeout(function() {--}}
    {{--                        // appending posts after last post with class="post"--}}
    {{--                        jQuery(".blog-item:last").after(response).show().fadeIn("slow");--}}

    {{--                        // checking row value is greater than allcount or not--}}
    {{--                        //jQuery(".load-more").text("Load more");--}}
    {{--                        //jQuery('.load-more').attr('lastID',);--}}
    {{--                    }, 2000);--}}
    {{--                }else{--}}
    {{--                    jQuery('.alert-warning').remove();--}}
    {{--                    jQuery(".blog-item:last").after('<div class="mb-0 alert alert-warning text-center">No more data available.</div>');--}}
    {{--                    jQuery(".load-more").hide();--}}
    {{--                    jQuery('.load-more').attr('lastID',0);--}}
    {{--                }--}}


    {{--            }--}}
    {{--        });--}}
    {{--    }--}}

    });

jQuery('#blog_cat_dd').change(function(){
    var url = "{{route('category', ['categories'=>':id'])}}";
    url = url.replace(':id', this.value);
   jQuery('.alert-warning').remove();
    window.location = url;

});
</script>
@stop


