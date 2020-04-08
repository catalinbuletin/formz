<div class="col-md-12">

    <label for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <textarea
        class="form-control"
        id="{{ $field->getId() }}">{{ $field->getValue() }}</textarea>
</div>
