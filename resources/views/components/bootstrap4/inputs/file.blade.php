<div class="custom-file">
    <input
            type="file"
            class="{{ $inputClass }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            value="{{ $field->getValue() }}"
            {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
    >
    <label class="custom-file-label" for="{{ $field->getId() }}">Choose file</label>
</div>
