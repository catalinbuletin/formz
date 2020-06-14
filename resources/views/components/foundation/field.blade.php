<div class="{{ $field->getAttributes()->get('container.class') }}">
    <label class="{{ $field->getAttributes()->get('label.class') }}"
           for="{{ $field->getAttributes()->get('input.id') }}"
    >

        {{ $field->getLabel() }}

        @if($field->isRequired())
            <span class="{{ $field->getAttributes()->get('required_asterisk_class') }}">*</span>
        @endif

        @include($input)

        @if ($errorMessage)
            <span class="form-error is-visible">
                {!! nl2br($errorMessage) !!}
            </span>
        @endif
    </label>

    @if ($field->getHelpText())
        <p class="help-text">
            {!! nl2br($field->getHelpText()) !!}
        </p>
    @endif
</div>
