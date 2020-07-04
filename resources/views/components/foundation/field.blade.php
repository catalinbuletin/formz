<div class="{{ $field->getAttributes()->get('container.class') }}"
     id="{{ $field->getAttributes()->get('container.id') }}"
>
    <label class="{{ $field->getAttributes()->get('label.class') }}"
           for="{{ $field->getAttributes()->get('input.id') }}"
    >

        {{ $field->getLabel() }}

        @if($field->isRequired())
            <span class="{{ $field->getAttributes()->get('required_asterisk_class') }}">*</span>
        @endif

        @include($input)

        @if ($field->errorMessage())
            <span class="form-error is-visible">
                {!! nl2br($field->errorMessage()) !!}
            </span>
        @endif
    </label>

    @if ($field->getHelpText())
        <p class="help-text">
            {!! nl2br($field->getHelpText()) !!}
        </p>
    @endif
</div>
