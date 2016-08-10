@if ($paginate->lastPage() > 1)
        <ul class="navPaging">
            <li>
                <a class="{{ ($paginate->currentPage() == 1) ? 'disabled' : '' }}" href="{{ $paginate->url(1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $paginate->lastPage(); $i++)
                <li>
                    <a class="{{ ($paginate->currentPage() == $i) ? 'current' : '' }}" href="{{ $paginate->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li>
                <a class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? 'disabled' : '' }}" href="{{ $paginate->url($paginate->currentPage()+1) }}" >Next</a>
            </li>
        </ul>
@endif