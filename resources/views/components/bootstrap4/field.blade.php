<div class="{{ $field->getAttributes()->get('container.class') }}">
    <label class="{{ $field->getAttributes()->get('label.class') }}"
           for="{{ $field->getAttributes()->get('input.id') }}"
    >

        {{ $field->getLabel() }}

        @if($field->isRequired())
            <span class="{{ $field->getAttributes()->get('required_asterisk_class') }}">*</span>
        @endif

    </label>

    @include($input)

    @if ($field->getHelpText())
        <small id="emailHelp" class="form-text text-muted">
            {!! nl2br($field->getHelpText()) !!}
        </small>
    @endif

    @if ($errorMessage)
        <div class="invalid-feedback">
            {!! nl2br($errorMessage) !!}
        </div>
    @endif
</div>
