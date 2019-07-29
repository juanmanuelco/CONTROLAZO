@if (count($errors)>0)
    <div class="centrado blanco mensaje-error-sistema animated flash">
        <h4 class="calibri">
            @foreach ($errors->all() as $error)
            {{ $error }},
            @endforeach
        </h4>
    </div>
    @endif
@if (session('status'))
    <div class="centrado blanco mensaje-bien-sistema animated flash">
        <h4 class="calibri">{{ session('status') }}</h4>
    </div>
@endif

@if (session('error'))
<div class="centrado blanco mensaje-error-sistema animated flash">
        <h4 class="calibri">{{ session('error') }}</h4>
    </div>
@endif