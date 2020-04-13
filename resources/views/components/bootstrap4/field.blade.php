<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    @include($input)

    @if ($hasErrors)
        <div class="invalid-feedback">
            {{ $errors ? $errors[0] : '' }}
        </div>
    @endif
</div>