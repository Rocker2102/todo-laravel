{{-- include from inside a container for proper rendering --}}

@if ($errors->any())
<div class="m-3">
    <div class="accordion" id="errorsAccordian">
        <div class="accordion-item border border-danger rounded">
            <h2 class="accordion-header" id="errorHeading">
                <button class="accordion-button alert-danger collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#errorsAccordCollapse"
                    aria-expanded="true" aria-controls="errorsAccordCollapse">
                    Oops! Looks like there were some errors!
                </button>
            </h2>
            <div id="errorsAccordCollapse" class="accordion-collapse collapse" aria-labelledby="errorHeading"
                data-bs-parent="#errorsAccordian">
                <div class="accordion-body">
                    @foreach ($errors->all() as $error)
                        {!! $loop->iteration . '. ' . $error . ($loop->last ? '' : '<br>') !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
