@extends('layouts.app')
@section('title','Student | Notice Board')

@section('content')
    <div class="ed-about-tit">
        <div class="con-title">
            <h2>School <span> Events</span></h2>
        </div>
        <div>
            <div class="container">
                <div class="col-sm-4">
                    <h3>Categories</h3>
                    <select class="form-control" id="blog_cat_dd">

                        @foreach(auth()->user()->schoolAdmin->categories as $_category)
                            <option value="{{$_category->slug}}" {{ (request()->route('categories') == $_category->slug)?'selected':'' }} >{{$_category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="ho-event pg-eve-main">
                <ul>
                    @if(count($articles)>0)
                        @include('student.article._category', [
                            'articles'=>$articles
                        ])
                    @else
                        <div class="mb-0 alert alert-warning text-center">No more data available123.</div>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                    {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection
@section('page_level_js')
    <script>
        jQuery(document).ready(function() {
            jQuery('#blog_cat_dd').change(function () {
                var url = "{{route('category', ['categories'=>':id'])}}";
                url = url.replace(':id', this.value);
                jQuery('.alert-warning').remove();
                window.location = url;

            });
        });
    </script>
@stop
