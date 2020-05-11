<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">

        {{ $field->getLabel() }}

        @if($isRequired)
            <span class="{{ $themeConfig['required_asterisk_class'] }}">*</span>
        @endif

    </label>

    @include($input)

    @if ($field->getHelpText())
        <small id="emailHelp" class="form-text text-muted">
            {!! nl2br($field->getHelpText()) !!}
        </small>
    @endif

    @if ($hasErrors)
        <div class="invalid-feedback">
            {!! nl2br($errorMessage) !!}
        </div>
    @endif
</div>
