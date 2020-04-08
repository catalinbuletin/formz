<div class="col-md-12">

    <label for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <select multiple class="form-control" id="{{ $field->getId() }}">
        @foreach($field->getOptions() as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>
</div>
