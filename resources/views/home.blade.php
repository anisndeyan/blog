@extends('layouts.app')

@section('content')
@if (session('massage'))
    <div class="alert alert-success">
        {{ session('massage') }}
    </div>
@endif
@endsection

