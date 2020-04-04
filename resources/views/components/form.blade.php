<form action="">

    @foreach($sections as $section)
{{--        {{ $section->getLabel() }}--}}
        <x-formz-section :section="$section"></x-formz-section>
    @endforeach
</form>