<div class="{{ $wrapperClass }}">
    <x-formz-label :field="$field"></x-formz-label>

    @include($input)

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>