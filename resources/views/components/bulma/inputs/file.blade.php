<div class="file">
    <label class="file-label">
        <input
            type="file"
            class="{{ $inputClass }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            value="{{ $field->getValue() }}">
        <span class="file-cta">
            <span class="file-icon">
                <i class="fas fa-upload"></i>
            </span>
            <span class="file-label">
                Choose a file…
            </span>
        </span>
    </label>
</div>
