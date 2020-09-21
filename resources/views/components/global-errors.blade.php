@if ($errorMessage || count($fieldErrors))
    <div class="{{ $themeConfig['error_class']['global'] }}">
        <div>{{ $errorMessage }}</div>
        @if(count($fieldErrors))
            <br>
            <ul>
                @foreach($fieldErrors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif