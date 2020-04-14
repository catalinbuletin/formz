<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <div class="control">
        @include($input)
    </div>

    @if ($hasErrors)
        <p class="help is-danger">
            {{ $errors ? $errors[0] : '' }}
        </p>
    @endif
</div>
