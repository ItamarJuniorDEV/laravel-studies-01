@extends('layouts.main_layout')
@section('content')

{{-- apresentar myName a partir da route::view --}}

{{-- Se $myName não estiver vazio --}}
@if (!empty($myName))
<p>{{ $myName }} </p>
@endif

@endsection