@extends('layouts.app')

@section('title', 'Feed')

@push('css')
    <link href="{{ asset('css/category.css') }}" rel="stylesheet"/>

@endpush

@push('js')
    <script src="{{ asset('js/feed.js') }}" type="module"> defer</script>

@endpush

@section('content')
    <div class="margin-from-nav content-general-margin">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <h1 class="mb-5">Feed</h1>

        <div class="row m-0 p-0">
            <div class="col-lg-9 px-0">
                @if(Auth::check())
                    <a href="{{ url('/recipe') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Create Recipe</a>
                @endif
                <div class="m-0 p-0 feed-recipes-area pe-5">
                    @if($recipes->count() > 0)
                        @foreach($recipes as $recipe)
                            @include('partials.preview.recipe')
                        @endforeach
                    @else
                        <p>There are no recipes available.</p>
                    @endif
                </div>

                <div class="row">
                    <button type="button" class="btn btn-dark load-more w-25 my-5 mx-auto load-more-button-feed"><i class="fas fa-plus me-2"></i> Load More</button>
                </div>
            </div>

            <div class="col-lg-3 ps-0 ps-xxl-4 pe-0 trending-topics-recipes">
                @include('partials.trending.trending_topics', ['tags' => $tags])
                @include('partials.trending.trending_recipes', ['trendingRecipes' => $trendingRecipes])
            </div>

        </div>


    </div>
@endsection
