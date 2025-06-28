@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Latihan JavaScript</h1>
    <p>Click the button below to see an alert.</p>
    <button id="alertButton" class="btn btn-primary">Click Me</button>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('alertButton').addEventListener('click',()=>alert('button clicked'));
        });
    </script>
@endpush

{{-- {{asset()}} --}}