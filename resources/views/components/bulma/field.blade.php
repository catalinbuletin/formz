<div class="{{ $field->getAttributes()->get('container.class') }}">
    <label class="{{ $field->getAttributes()->get('label.class') }}"
           for="{{ $field->getAttributes()->get('input.id') }}"
    >

        {{ $field->getLabel() }}

        @if($field->isRequired())
            <span class="{{ $field->getAttributes()->get('required_asterisk_class') }}">*</span>
        @endif

    </label>

    <div class="control {{ $field->errorMessage() ? 'has-icons-right' : '' }}">

        @include($input)

        @if ($field->errorMessage())
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        @endif

    </div>

    @if ($field->getHelpText())
        <p class="help">
            {!! nl2br($field->getHelpText()) !!}
        </p>
    @endif

    @if ($field->errorMessage())
        <p class="help is-danger">
            {!! nl2br($field->errorMessage()) !!}
        </p>
    @endif
</div>
