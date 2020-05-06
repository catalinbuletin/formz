<div class="select is-fullwidth">
    <select class="{{ $inputClass }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
    >
        @foreach($field->getOptions() as $option)
            <option
                    value="{{ $option->getValue() }}"
                    {{ $request->old($field->getName(), (string)$field->getValue()) === $option->getValue() ? "selected" : "" }}
            >
                    {{ $option->getLabel() }}
            </option>
        @endforeach
    </select>
</div>
