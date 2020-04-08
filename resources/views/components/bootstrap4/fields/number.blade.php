<div class="col-md-12">

    <label for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <input
        type="number"
        class="form-control"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        placeholder="{{ $attributes->get('placeholder') }}">
</div>
