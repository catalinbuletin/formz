@foreach($field->getOptions() as $option)
    <label class="radio">
        <input class="{{ $inputClass }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option->getValue() }}"
               value="{{ $option->getValue() }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === $option->getValue() ? "checked" : "" }}
        >
        {{ $option->getLabel() }}
    </label>
@endforeach
