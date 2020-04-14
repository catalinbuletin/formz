<div class="custom-file">
    <input
            type="file"
            class="{{ $inputClass }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            value="{{ $field->getValue() }}"
    >
    <label class="custom-file-label" for="{{ $field->getId() }}">Choose file</label>
</div>