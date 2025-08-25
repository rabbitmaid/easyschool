  {{-- Success Message --}}
  @if(session()->has('success'))
  <div class="text-cnter alert alert-success  alert-dismissible border border-success" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
      <div class="alert-message">
          {{ session('success') }}
      </div>
  </div>
  @endif

  {{-- Failure Message --}}
  @if(session()->has('failure'))
  <div class="text-cnter alert alert-danger  alert-dismissible border border-danger" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
      </button>
      <div class="alert-message">
          {{ session('failure') }}
      </div>
  </div>
  @endif