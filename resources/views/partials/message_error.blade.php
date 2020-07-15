{{-- Si la session tiene un mensaje con la llave flash--}}
@if (session()->has('flash'))
    {{-- flash declarada en el controlador --}}
    <div class="alert alert-danger">{{session('flash')}}</div>
@endif
