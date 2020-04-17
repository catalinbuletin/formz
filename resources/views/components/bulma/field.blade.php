<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <div class="control {{ $hasErrors ? 'has-icons-right' : '' }}">
        @include($input)
        @if ($hasErrors)
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        @endif
    </div>

    @if ($hasErrors)
        <p class="help is-danger">
            {{ $errors ? $errors[0] : '' }}
        </p>
    @endif
</div>
