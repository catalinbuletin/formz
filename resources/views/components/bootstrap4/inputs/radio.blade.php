@foreach($field->getOptions() as $option)
    <div class="custom-control custom-radio">
        <input class="{{ $field->getAttributes()->get('input.class') }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option->getValue() }}"
               value="{{ $option->getValue() }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === $option->getValue() ? "checked" : "" }}
                {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
        >
        <label class="custom-control-label" for="{{ $field->getName() . '-' . $option->getValue() }}">
            {{ $option->getLabel() }}
        </label>
    </div>
@endforeach

