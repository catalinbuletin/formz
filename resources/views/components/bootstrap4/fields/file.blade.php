<div class="col-md-12">

    <x-formz-label :field="$field"></x-formz-label>

    <input
        type="file"
        class="form-control-file {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
    >

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
