@foreach($field->getOptions() as $option)
    <div class="form-check">
        <input class="{{ $field->getAttributes()->get('input.class') }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option->getValue() }}"
               value="{{ $option->getValue() }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === $option->getValue() ? "checked" : "" }}
                {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
        >
        <label class="form-check-label" for="{{ $field->getName() . '-' . $option->getValue() }}">
            {{ $option->getLabel() }}
        </label>
    </div>
@endforeach

