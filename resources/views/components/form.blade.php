<form action="">

    @foreach($sections as $section)
        <x-formz-section :section="$section"></x-formz-section>
    @endforeach

</form>