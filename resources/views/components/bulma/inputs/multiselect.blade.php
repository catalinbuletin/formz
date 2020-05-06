<div class="select is-multiple is-fullwidth">
    <select multiple
            class="{{ $inputClass }}"
            name="{{ $field->getName() }}[]"
            id="{{ $field->getId() }}"
            {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
    >
            @foreach($field->getOptions() as $option)
                    <option
                            value="{{ $option->getValue() }}"
                            {{ in_array($option->getValue(), $request->old($field->getName(), $field->getValue())) ? "selected" : "" }}
                    >
                            {{ $option->getLabel() }}
                    </option>
            @endforeach
    </select>
</div>
