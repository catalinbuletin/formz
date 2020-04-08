<form action="{{ $action }}" method="post">

    {{ $header }}

    @foreach($form->getSections() as $section)
        <x-formz-section :section="$section"></x-formz-section>
    @endforeach

    {{ $footer }}

</form>
