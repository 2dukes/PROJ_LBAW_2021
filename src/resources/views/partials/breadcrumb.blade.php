@push('css')
    <link href="{{ asset('css/components/breadcrumb.css') }}" rel="stylesheet"/>
@endpush

@php
    $navClass = '';
    if (!$withoutMargin) $navClass = 'content-general-margin';
@endphp

<nav style="--bs-breadcrumb-divider: '>';" class="{{ $navClass }} margin-from-nav" aria-label="breadcrumb">
    <ol class="breadcrumb p-2">
        <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="{{ Auth::guard('admin')->check() ? '/admin/users' : '/feed' }}">Home</a></li>

        @php
            $keys = array_keys($pages);
            $lastKey = end($keys);
        @endphp

        @for($i = 0; $i < count($pages) - 1; $i++)
            <li class="breadcrumb-item"><a href="{{ $pages[$keys[$i]] }}">{{ $keys[$i] }}</a></li>
        @endfor
        <li class="breadcrumb-item last-breadcrumb" aria-current="page"><a href="{{ $pages[$lastKey] }}">{{ $lastKey }}</a></li>

    </ol>
</nav>
