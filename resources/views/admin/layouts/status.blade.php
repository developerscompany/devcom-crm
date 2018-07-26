@if (session('status'))
    <div class="alert alert-success status">
        {{ session('status') }}
    </div>
@endif