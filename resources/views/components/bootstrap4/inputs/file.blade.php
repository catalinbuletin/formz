<div class="custom-file">
    <input
            type="file"
            class="{{ $field->getAttributes()->get('input.class') }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getAttributes()->get('input.id') }}"
            value="{{ $field->getValue() }}"
            {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
    >
    <label class="custom-file-label" for="{{ $field->getAttributes()->get('input.id') }}">Choose file</label>
</div>
