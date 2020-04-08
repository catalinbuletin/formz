<div class="col-md-12">

    <label>
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    @foreach($field->getOptions() as $option)
        <div class="form-check">
            <input class="form-check-input"
                   type="radio"
                   name="{{ $field->getName() }}"
                   id="{{ $field->getName() . '-' . $option['value'] }}"
                   value="{{ $option['value'] }}">
            <label class="form-check-label" for="{{ $field->getName() . '-' . $option['value'] }}">
                {{ $option['label'] }}
            </label>
        </div>
    @endforeach
</div>
