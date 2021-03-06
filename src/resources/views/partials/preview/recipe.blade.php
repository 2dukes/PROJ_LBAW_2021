@push('css')
    <link href="{{ asset('css/components/post.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('js/clipboard.js') }}" type="module"></script>
@endpush

<div class="card shadow-sm recipe-post mt-5">
    @if(Gate::inspect('update', $recipe)->allowed() || Gate::inspect('delete', $recipe)->allowed())
        <div class="col-sm post-options">
            <div class="dropdown">
                <button type="button" class="btn edit-photo-button float-end me-2 mt-2 btn-no-shadow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @if(Gate::inspect('update', $recipe)->allowed())
                        <li><button class="dropdown-item ms-3 has-link" data-role="a" data-href="{{ url("recipe/$recipe->id/edit") }}">Edit Post</button></li>
                    @endif
                    @if(Gate::inspect('delete', $recipe)->allowed())
                        <li><button class="dropdown-item ms-3" data-role="a" data-bs-toggle="modal" data-bs-target="#recipeDeleteConfirmationModal{{ $recipe->id }}">Delete Post</button></li>
                    @endif
                </ul>
            </div>
        </div>
    @endif

    <div class="card-body">

        <div class="row user-info">
            <div class="col avatar-image">
                <img class="rounded-circle z-depth-2"
                     src="{{$recipe->author->profileImage()}}"
                     alt="profile picture of {{$recipe->author->name}}, the author of the recipe">
            </div>
            <div class="col name-and-date ms-4">
                <div>
                    <a href="{{url('user/' . $recipe->author->username)}}" style="text-decoration: none">
                        <strong>{{$recipe->author->name}}</strong>
                    </a>
                </div>
                <div class="publication-date">@include('partials.date', ['date' => $recipe->creation_time])</div>
            </div>
        </div>

        <a href="{{url("recipe/$recipe->id")}}" class="btn card p-2 shadow-sm recipe-preview mt-4">
            <div class="row px-3">
                <div class="col-md post-image"
                     style="background-image: url('{{ $recipe->getProfileImage() }}')">
                </div>
                <div class="col-md w-50 text-recipe pt-4 pt-md-2 px-0 ps-md-4">
                    <div class="text-recipe">
                        <h4 class="card-title">{{$recipe->name}}</h4>
                        <p class="card-text post-description">{{$recipe->description}}</p>
                        <p>
                            <small class="text-muted">
                                @include('partials.rating', [ 'score' => $recipe->score, 'num_rating' => $recipe->num_rating ])
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </a>

        <div class="container mt-4 p-0 ">
            <a class="btn btn-sm btn-secondary d-inline-block me-3 mb-2"
               href='{{url("search?searchQuery=" . $recipe->category->name)}}'>
                {{$recipe->category->name}}
            </a>
            @foreach ($recipe->tags as $tag)
                <a class="btn btn-sm btn-outline-secondary d-inline-block me-3 mb-2"
                   href="{{url("search?searchQuery=" . $tag->name)}}">
                    {{$tag->name}}
                </a>
            @endforeach
        </div>
    </div>
    <div class="btn-group col-sm d-flex justify-content-center text-center">
        @if(Auth::user() != null)
            <button type="button" class="btn post-button add-to-favourites-recipe-button"
            data-favourite-state="{{ $recipe->isFavourited() ? "true" : "false" }}"
            data-recipe-id="{{ $recipe->id }}" data-complete-text="1">
                <i class="fas fa-heart me-2"></i>
                <span class="button-caption">{{ $recipe->isFavourited() ? "Remove from Favourites" : "Add to Favourites" }}</span>
            </button>
        @endif
        <a href="{{url("recipe/$recipe->id")}}" class="btn post-button">
            <i class="fas fa-eye me-2"></i>
            <span class="button-caption">View Recipe</span>
        </a>
        <button class="btn post-button copy-link-button" data-link='{{ url('/recipe/' . $recipe->id) }}'>
            <i class="fas fa-share-alt me-2"></i>
            <span class="button-caption">Share</span>
        </button>
    </div>
</div>
@include('partials.confirmation', [
    'modalId' => 'recipeDeleteConfirmationModal'.$recipe->id,
    'modalTitle' => 'Delete recipe "'.$recipe->name.'"',
    'modalMessage' => 'Do you really want to delete this recipe? This action is irreversible!',
    'modalYesClass' => 'deleteRecipePreviewButton',
    'modalYesData' => $recipe->id,
    'modalYesText' => 'Yes',
    'modalNoText' => 'No'
])
