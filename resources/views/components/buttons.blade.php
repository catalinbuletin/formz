<div class="{{ $themeConfig['buttons']['wrapper_class'] }}" style="text-align: {{ $config['buttons']['placement'] }}">
    <button type="submit" class="{{ $themeConfig['buttons']['submit']['class'] }}">
        @if (!empty($themeConfig['buttons']['submit']['icon']))
            <i class="{{ $themeConfig['buttons']['submit']['icon'] }}"></i>
        @endif
        {{ $config['buttons']['submit_label'] }}
    </button>

    @if(!empty($cancelUrl))
        <a href="{{ $cancelUrl }}" class="{{ $themeConfig['buttons']['cancel']['class'] }}">
            @if (!empty($themeConfig['buttons']['cancel']['icon']))
                <i class="{{ $themeConfig['buttons']['cancel']['icon'] }}"></i>
            @endif

            {{ $config['buttons']['cancel_label'] }}
        </a>
    @endif
</div>