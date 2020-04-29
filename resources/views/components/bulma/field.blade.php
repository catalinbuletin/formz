<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">

        {{ $field->getLabel() }}

        @if($isRequired)
            <span class="required">*</span>
        @endif

    </label>

    <div class="control {{ $hasErrors === true ? 'has-icons-right' : '' }}">

        @include($input)

        @if ($hasErrors === true)
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        @endif

    </div>

    @if ($hasErrors === true)
        <p class="help is-danger">
            {!! nl2br($errorMessage) !!}
        </p>
    @endif
</div>
