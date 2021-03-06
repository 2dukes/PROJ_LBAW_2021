@push('css')
    <link href="{{ asset('css/components/filterSortBar.css') }}" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ asset('js/filterSortBar.js') }}" type="module"></script>
@endpush

<form name="filterBar">
    <div id="filterBar" class="input-group">
        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-filter me-2"></i> Filter by</span>
        <select class="form-select clickable filter-bar-input category-select" name="category" aria-label="Category">
            <option selected value="0">-- Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false">Tags</button>
        <ul id="tagFilterDropdown" class="dropdown-menu">
            <button type="submit" class="btn btn-primary mb-3 me-2">Filter</button>
            <button class="btn btn-outline-secondary mb-3 clear-parents-checkboxes">Clear</button>
            @foreach($tags as $tag)
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input tag-filter-checkbox filter-bar-input synchronized-checkbox tag-check-{{$tag->id}}" data-synchronized-class="tag-check-{{$tag->id}}" name="tag{{ $tag->id }}" data-id="{{ $tag->id }}" type="checkbox">
                        {{ $tag->name }}
                    </label>
                </div>
            @endforeach
        </ul>
        <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Rating">Rating</button>
        <ul class="dropdown-menu">
            <div class="mb-3">
                <label for="filterRatingMinInputDesktop" class="form-label visually-hidden">From</label>
                <div>From <span>0</span></div>
                <input type="range" name="filterRatingMinInput" class="form-range filter-rating-min-input filter-bar-input" min="0" max="5" step="0.1" value="0" id="filterRatingMinInputDesktop">
            </div>
            <div class="mb-3">
                <label for="filterRatingMaxInputDesktop" class="form-label visually-hidden">To</label>
                <div>To <span>5</span></div>
                <input type="range" name="filterRatingMaxInput" class="form-range filter-rating-max-input form-control filter-bar-input" min="0" max="5" step="0.1" value="5" id="filterRatingMaxInputDesktop">
            </div>
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <button id="clearFilterRating" class="btn btn-outline-secondary">Clear</button>
        </ul>
        <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Ingredients">Ingredients</button>
        <ul id="ingredientFilterDropdown" class="dropdown-menu">
            <button type="submit" class="btn btn-primary mb-3 me-2">Filter</button>
            <button class="btn btn-outline-secondary mb-3 clear-parents-checkboxes">Clear</button>
            @foreach($ingredients as $ingredient)
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input ingredient-filter-checkbox filter-bar-input synchronized-checkbox ingredient-check-{{$ingredient->id}}" data-synchronized-class="ingredient-check-{{$ingredient->id}}" name="ingredient{{ $ingredient->id }}" data-id="{{ $ingredient->id }}" type="checkbox">
                        {{ $ingredient->name }}
                    </label>
                </div>
            @endforeach
        </ul>
        <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Publication date">Date</button>
        <ul class="dropdown-menu">
            <div class="mb-3">
                <label class="form-label">
                    From
                    <input type="date" name="filterDateMinInput" max="{{ date('Y-m-d') }}" class="form-control filter-date-min-input filter-bar-input">
                </label>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    To
                    <input type="date" name="filterDateMaxInput" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control filter-date-max-input filter-bar-input">
                </label>
            </div>
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <button id="clearFilterDate" class="btn btn-outline-secondary">Clear</button>
        </ul>
        <button class="form-select text-left-align" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Duration">Duration</button>
        <ul class="dropdown-menu">
            <div class="mb-3">
                <label for="filterDurationMinInputDesktop" class="form-label visually-hidden">From</label>
                <div>From <span>0min</span></div>
                <input type="range" name="filterDurationMinInput" class="form-range time-in-mins filter-duration-min-input filter-bar-input" min="0" max="300" value="0" step="5" id="filterDurationMinInputDesktop">
            </div>
            <div class="mb-3">
                <label for="filterDurationMaxInputDesktop" class="form-label visually-hidden">To</label>
                <div>To <span>5h</span></div>
                <input type="range" name="filterDurationMaxInput" class="form-range time-in-mins filter-duration-max-input filter-bar-input" min="0" max="300" value="600" step="5" id="filterDurationMaxInputDesktop">
            </div>
            <button type="submit" class="btn btn-primary me-2">Filter</button>
            <button id="clearFilterDuration" class="btn btn-outline-secondary">Clear</button>
        </ul>
        <select class="form-select clickable filter-bar-input difficulty-select" name="difficulty" aria-label="Difficulty">
            <option value="0" selected>-- Difficulty --</option>
            <option value="easy">Easy</option>
            <option value="medium">Medium</option>
            <option value="hard">Hard</option>
            <option value="very hard">Very hard</option>
        </select>
    </div>
</form>


@if($showSortBar)
    <div id="sortBar" class="input-group mt-3">
        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-sort me-2"></i>Sort by</span>
        <select class="form-select clickable" aria-label="Type to sort by">
            <option selected value="relevance">Relevance</option>
            <option value="published_date">Date published</option>
            <option value="title">Title</option>
            <option value="cost">Cost</option>
            <option value="duration">Duration</option>
            <option value="rating">Rating</option>
        </select>
        <select class="form-select clickable" aria-label="Order to sort by">
            <option selected value="desc">Descendant</option>
            <option value="asc">Ascendant</option>
        </select>
    </div>
@endif


<button id="filterBarMobileHeading" class="btn btn-secondary collapsed me-2 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#filterButtons" aria-expanded="false" aria-controls="filterButtons">
    <i class="fas fa-filter"></i> Filter
</button>

@if($showSortBar)
<button id="sortBarMobileHeading" class="btn btn-secondary collapsed mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#sortButtons" aria-expanded="false" aria-controls="sortButtons">
    <i class="fas fa-sort"></i> Sort
</button>
@endif

<script>
    const filterButton = document.querySelector('#filterBarMobileHeading');
    const sortButton = document.querySelector('#sortBarMobileHeading');

    filterButton.addEventListener('click', () => {
        if (sortButton.getAttribute('aria-expanded') === "true") sortButton.click()
    });

    sortButton?.addEventListener('click', () => {
        if (filterButton.getAttribute('aria-expanded') === "true") filterButton.click()
    });
</script>

<form id="filterBarMobile">
    <div id="filterButtons" class="collapse" aria-labelledby="filterBarMobileHeading" data-bs-parent="#filterBarMobile">
        <!-- Start of filter buttons accordion -->
        <div id="filterBarMobileOptions" class="accordion">
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed category-select" aria-label="Category">
                    <option selected value="0">Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="tagsHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tagsBody" aria-expanded="false" aria-controls="tagsBody">
                        Tags
                    </button>
                </h2>
                <div id="tagsBody" class="accordion-collapse collapse" aria-labelledby="tagsHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <button type="submit" class="btn btn-primary mb-3 me-2">Filter</button>
                        <button class="btn btn-outline-secondary mb-3 clear-parents-checkboxes">Clear</button>
                        @foreach($tags as $tag)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input tag-filter-checkbox filter-bar-input synchronized-checkbox tag-check-{{$tag->id}}" data-synchronized-class="tag-check-{{$tag->id}}" name="tag{{ $tag->id }}" data-id="{{ $tag->id }}" type="checkbox">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item accordion-header">
                <select class="accordion-button form-select collapsed difficulty-select" aria-label="Difficulty">
                    <option value="0" selected>Difficulty</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                    <option value="very hard">Very hard</option>
                </select>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="ratingHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ratingBody" aria-expanded="false" aria-controls="ratingBody">
                        Rating
                    </button>
                </h2>
                <div id="ratingBody" class="accordion-collapse collapse" aria-labelledby="ratingHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for="filterRatingMinInputMobile" class="form-label visually-hidden">From</label>
                            <div>From <span>0</span></div>
                            <input type="range" class="form-range filter-rating-min-input" min="0" max="5" step="0.1" value="0" id="filterRatingMinInputMobile">
                        </div>
                        <div class="mb-3">
                            <label for="filterRatingMaxInputMobile" class="form-label visually-hidden">To</label>
                            <div>To <span>5</span></div>
                            <input type="range" class="form-range filter-rating-max-input" min="0" max="5" step="0.1" value="5" class="form-control" id="filterRatingMaxInputMobile">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <button id="clearFilterRating" class="btn btn-outline-secondary">Clear</button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="ingredientsHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ingredientsBody" aria-expanded="false" aria-controls="ingredientsBody">
                        Ingredients
                    </button>
                </h2>
                <div id="ingredientsBody" class="accordion-collapse collapse" aria-labelledby="ingredientsHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <button type="submit" class="btn btn-primary mb-3 me-2">Filter</button>
                        <button class="btn btn-outline-secondary mb-3 clear-parents-checkboxes">Clear</button>
                        @foreach($ingredients as $ingredient)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input ingredient-filter-checkbox filter-bar-input synchronized-checkbox ingredient-check-{{$ingredient->id}}" data-synchronized-class="ingredient-check-{{$ingredient->id}}" name="ingredient{{ $ingredient->id }}" data-id="{{ $ingredient->id }}" type="checkbox">
                                    {{ $ingredient->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="dateHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dateBody" aria-expanded="false" aria-controls="dateBody">
                        Date
                    </button>
                </h2>
                <div id="dateBody" class="accordion-collapse collapse" aria-labelledby="dateHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label class="form-label">
                                From
                                <input type="date" name="filterDateMinInput" max="{{ date('Y-m-d') }}" class="form-control filter-date-min-input filter-bar-input">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                To
                                <input type="date" name="filterDateMaxInput" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" class="form-control filter-date-max-input filter-bar-input">
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <button id="clearFilterDate" class="btn btn-outline-secondary">Clear</button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="durationHeading">
                    <button class="accordion-button form-select collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#durationBody" aria-expanded="false" aria-controls="durationBody">
                        Duration
                    </button>
                </h2>
                <div id="durationBody" class="accordion-collapse collapse" aria-labelledby="durationHeading" data-bs-parent="#filterBarMobileOptions">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for="filterDurationMinInputDesktop" class="form-label visually-hidden">From</label>
                            <div>From <span>0min</span></div>
                            <input type="range" name="filterDurationMinInput" class="form-range time-in-mins filter-duration-min-input filter-bar-input" min="0" max="300" value="0" step="5" id="filterDurationMinInputDesktop">
                        </div>
                        <div class="mb-3">
                            <label for="filterDurationMaxInputDesktop" class="form-label visually-hidden">To</label>
                            <div>To <span>5h</span></div>
                            <input type="range" name="filterDurationMaxInput" class="form-range time-in-mins filter-duration-max-input filter-bar-input" min="0" max="300" value="600" step="5" id="filterDurationMaxInputDesktop">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <button id="clearFilterDuration" class="btn btn-outline-secondary">Clear</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of filter buttons accordion -->
    </div>
</form>

@if($showSortBar)
    <div id="sortBarMobile">
        <div id="sortButtons" class="collapse" aria-labelledby="sortBarMobileHeading" data-bs-parent="#sortBarMobile">
            <!-- Start of sort buttons accordion -->
            <div id="sortBarMobileOptions" class="accordion">
                <div class="accordion-item accordion-header">
                    <select class="accordion-button form-select collapsed" aria-label="Type to sort by">
                        <option selected value="relevance">Relevance</option>
                        <option value="published_date">Date published</option>
                        <option value="title">Title</option>
                        <option value="cost">Cost</option>
                        <option value="duration">Duration</option>
                        <option value="rating">Rating</option>
                    </select>
                </div>
                <div class="accordion-item accordion-header">
                    <select class="accordion-button form-select collapsed" aria-label="Order to sort by">
                        <option selected value="desc">Descendant</option>
                        <option value="asc">Ascendant</option>
                    </select>
                </div>
            </div>
            <!-- End of filter buttons accordion -->
        </div>
    </div>
@endif
