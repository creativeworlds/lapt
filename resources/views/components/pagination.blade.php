@php
    $visible_range = 9;
    $start = max(1, $data->currentPage() - (int) floor($visible_range / 2));
    $end = min($data->lastPage(), $start + $visible_range - 1);

    // If end is near the end but start too small, shift start back so we still have visible_range pages
    if (($end - $start + 1) < $visible_range)
        $start = max(1, $end - $visible_range + 1);
@endphp

@if ($data->lastPage() > 1)
    <div class="pagination">

        {{-- first page and leading ellipsis --}}
        @if ($start > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}">1</a>
            @if ($start > 2)
                <span class="ellipsis">...</span>
            @endif
        @endif

        {{-- page links in visible window --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $data->currentPage())
                <span class="current">{{ $i }}</span>
            @else
                <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
            @endif
        @endfor

        {{-- trailing ellipsis and last page --}}
        @if ($end < $data->lastPage())
            @if ($end < $data->lastPage() - 1)
                <span class="ellipsis">...</span>
            @endif
            <a href="{{ request()->fullUrlWithQuery(['page' => $data->lastPage()]) }}">{{ $data->lastPage() }}</a>
        @endif
    </div>
@endif