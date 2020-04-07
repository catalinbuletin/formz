<form action="">

    @foreach($form->getSections() as $section)
        <x-formz-section :section="$section"></x-formz-section>
    @endforeach

</form>