<div class="col-md-12">

    <x-formz-label :label="$field->getLabel()"
                   :for-id="$field->getId()"
                   :is-required="$isRequired"></x-formz-label>

    @foreach($field->getOptions() as $option)
        <div class="form-check">
            <input class="form-check-input {{ $hasErrors ? 'is-invalid' : '' }}"
                   type="radio"
                   name="{{ $field->getName() }}"
                   id="{{ $field->getName() . '-' . $option['value'] }}"
                   value="{{ $option['value'] }}">
            <label class="form-check-label" for="{{ $field->getName() . '-' . $option['value'] }}">
                {{ $option['label'] }}
            </label>
        </div>
    @endforeach

    @if ($hasErrors)
        <x-formz-error :errors="$errors"></x-formz-error>
    @endif
</div>
