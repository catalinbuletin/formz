<div class="formz-section form-row">
    @if($section->getLabel())
        <div class="col-lg-12">
            <div class="formz__section-name">{{ $section->getLabel() }}</div>
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>

<style>
    .formz-section {
        margin-bottom: 30px;
    }

    .formz__section-name {
        margin-bottom: 15px;
    }
</style>