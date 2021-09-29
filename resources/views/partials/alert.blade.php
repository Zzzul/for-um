@if (session()->has('success'))
    <div class="alert alert-dismissible alert-success mb-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading font-weight-bold">Success!</h4>
        <p class="mb-0">{{ session()->get('success') }}</p>
    </div>
@endif

@if (session()->has('error'))
    <div class="alert alert-dismissible alert-warning mb-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4 class="alert-heading font-weight-bold">Warning!</h4>
        <p class="mb-0">{{ session()->get('error') }}</p>
    </div>
@endif
