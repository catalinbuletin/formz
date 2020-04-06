<div class="{{ $attributes->get('container.class') }}">
    <label for="{{ $field->getId() }}" class="control-label">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>
    <input
            type="text"
            id="{{ $field->getId() }}"
            class="{{ $attributes->get('class') }}"
            placeholder="{{ $attributes->get('placeholder') }}"
    >
</div>