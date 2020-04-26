<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">

        {{ $field->getLabel() }}

        @if($isRequired)
            <span class="required">*</span>
        @endif

        @include($input)

        @if ($hasErrors)
            <span class="form-error is-visible">
                {!! nl2br($errorMessage) !!}
            </span>
        @endif
    </label>
</div>