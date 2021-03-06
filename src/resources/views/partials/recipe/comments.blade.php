<section class="icon-box mt-5 shadow-sm text-start" id="comments">
    <i class="fas fa-comments"></i>
    <h4 class="d-none">Comments</h4>
    <h5 class="d-none">User Comments</h5>
    @foreach ($comments as $i => $comment)
        @include('partials.recipe.comment', [ 'comment' => $comment, 'depth' => 0 ])
    @endforeach
    <h3 class="mt-4">Comment on the recipe</h3>
    @if(Gate::inspect('create', \App\Models\Comment::class)->allowed())
        <form name="createCommentForm" class="form-floating m-3 position-relative">
            <input type="hidden" name="recipeId" value="{{ $recipe->id }}" />
            <textarea required name="content" id="commentContent" class="form-control" placeholder="Leave a comment here" style="height: 6rem"></textarea>
            <label for="commentContent">Your comment</label>
            <button type="submit" class="btn btn-primary position-absolute py-1 send has-tooltip" title="Post your comment">
                <small>
                    <i class="fas fa-paper-plane me-2"></i>
                    Comment
                </small>
            </button>
            @include('partials.ratinginput')
        </form>
    @else
        <p class="mt-4 ms-3">To comment, <a href="{{ url("/register") }}">register</a> or <a href="{{ url("/login") }}">log in</a>.</p>
    @endif
</section>
