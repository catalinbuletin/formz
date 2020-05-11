<div class="{{ $wrapperClass }}">
    <label class="{{ $labelClass }}" for="{{ $field->getId() }}">

        {{ $field->getLabel() }}

        @if($isRequired)
            <span class="{{ $themeConfig['required_asterisk_class'] }}">*</span>
        @endif

    </label>

    <div class="control {{ $errorMessage ? 'has-icons-right' : '' }}">

        @include($input)

        @if ($errorMessage)
            <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
        @endif

    </div>

    @if ($field->getHelpText())
        <p class="help">
            {!! nl2br($field->getHelpText()) !!}
        </p>
    @endif

    @if ($errorMessage)
        <p class="help is-danger">
            {!! nl2br($errorMessage) !!}
        </p>
    @endif
</div>
