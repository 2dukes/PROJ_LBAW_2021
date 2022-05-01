<section id="method" class="mt-5">
    <h2 class="p-0">Method</h2>
    @foreach ($steps as $idx => $step)
        <section class="instruction d-inline-block col-12 mt-4">
            <h3>
                <a class="btn p-0 has-tooltip" data-bs-toggle="collapse" href="#instruction{{ $idx+1 }}" aria-expanded="false" aria-controls="instruction{{ $idx+1 }}" title="Click to hide or show this step" style="box-shadow: 0 0 0">
                    <i class="fas fa-check-circle d-inline-block align-middle"></i>
                    <span class="d-inline-block align-middle">{{ $step->name == '' ? "Step ".($idx+1) : $step->name }}</span>
                </a>
            </h3>
            <div class="collapse show" id="instruction{{ $idx+1 }}">
                <div class="d-md-flex">
                    <div class="col-md-{{ !isset($step['image']) ? "12" : "8" }} card card-body d-inline-block p-0 mt-3">
                        {{ $step->description }}
                    </div>
                    <?php if (isset($step['image'])) { ?>
                        <img class="col-12 col-md-3 d-inline-block mt-3 mt-md-0 ms-md-3" src="{{ $step['image'] }}" alt="image of step {{$step->name}}">
                    <?php } ?>
                </div>
            </div>
        </section>
    @endforeach
</section>
