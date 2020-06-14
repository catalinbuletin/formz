<div class="file">
    <label class="file-label">
        <input
            type="file"
            class="{{ $field->getAttributes()->get('input.class') }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getAttributes()->get('input.id') }}"
            value="{{ $field->getValue() }}"
            {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
        >
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
