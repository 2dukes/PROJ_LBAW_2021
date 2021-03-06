<h5 class="mb-3 step-number">Step {{ $index }}</h5>
<div>
    <div class="form-floating mb-3" title="Enter a name to this step">
        @if($hasErrors)
            <input maxlength="30" name="steps[{{ $index - 1 }}][name]" type="text" class="form-control" id="stepName" placeholder="Preparation Time"
                value="{{ $oldStep['name'] }}">
        @else
            <input maxlength="30" name="steps[{{ $index - 1 }}][name]" type="text" class="form-control" id="stepName" placeholder="Preparation Time"
                value="{{ isset($step->name) ? $step->name : "" }}">
        @endif
        <label for="stepName">Step Name</label>
    </div>
    <div class="form-floating mb-4" title="Enter a nice step description">
        @if($hasErrors)
            <textarea minlength="10" maxlength="512" name="steps[{{ $index - 1 }}][description]" class="form-control step-textarea" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem">{{ $step['description'] }}</textarea>
        @else
            <textarea minlength="10" maxlength="512" name="steps[{{ $index - 1 }}][description]" class="form-control step-textarea" placeholder="Your awesome description here..." id="floatingTextarea2" style="height: 5rem">{{ isset($step->description) ? $step->description : "" }}</textarea>
        @endif
        <label for="floatingTextarea2">Step Description <span class='form-required'></span></label>
    </div>
    <h6 class="mb-3">Step Photos</h6>
    <div class="step-photo-input" data-index="{{ $index }}">
        @if (isset($stepImages) && isset($step) && array_key_exists($step->id, $stepImages))
            <span data-url="{{ $stepImages[$step->id]['url'] }}" data-name="{{ $stepImages[$step->id]['name'] }}"></span>
        @endif
    </div>
</div>
