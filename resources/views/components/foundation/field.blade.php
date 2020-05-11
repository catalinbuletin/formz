<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">

        {{ $field->getLabel() }}

        @if($isRequired)
            <span class="{{ $themeConfig['required_asterisk_class'] }}">*</span>
        @endif

        @include($input)

        @if ($hasErrors)
            <span class="form-error is-visible">
                {!! nl2br($errorMessage) !!}
            </span>
        @endif
    </label>
</div>
