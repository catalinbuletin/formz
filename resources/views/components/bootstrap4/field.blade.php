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

    </label>

    @include($input)

    @if ($field->getHelpText())
        <small id="emailHelp" class="form-text text-muted">
            {!! nl2br($field->getHelpText()) !!}
        </small>
    @endif

    @if ($field->errorMessage())
        <div class="invalid-feedback">
            {!! nl2br($field->errorMessage()) !!}
        </div>
    @endif
</div>
