@extends('layouts.app')

@section('content')
    <div class="pt-2">
        <h2>Editar Orçamento #{{ $budget->id}}</h2>
    </div>
    <div>
        @include('budgets.includes.form')
    </div>
@endsection