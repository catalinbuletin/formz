<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif

        @include($input)

        @if ($hasErrors)
            <span class="form-error is-visible">
                {{ $errors ? $errors[0] : '' }}
            </span>
        @endif
    </label>
</div>