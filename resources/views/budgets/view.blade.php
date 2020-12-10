@extends('layouts.app')

@section('content')

<div class="pull-left pt-2">
    <h2>Orçamentos</h2>
</div>
<div class="justify-align-items text-right mb-2 pt-2">
    <a class="btn btn-light" href="{{ route('budget.create') }}">
        <i class="fa fa-plus"></i>
        Cadastrar
    </a>
</div>
<form>
    <div class="col-xs-12 pr-2">
        <label class="text-muted pt-3" style="font-size: 15px;">Filtrar por:</label>
        <div>
            <label class="mr-3">
                <input type="checkbox" name="customer" {{ (empty($query) ||  !empty($query['title'])) ? 'checked' : null }}> Cliente
            </label>
            <label class="mr-3">
                <input type="checkbox" name="salesman" {{ (empty($query) ||  !empty($query['description'])) ? 'checked' : null }}> Vendedor
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-11 pr-2">
            <div class="form-group">
                <input type="text" id="search" name="search" placeholder="" value="{{ !empty($query['search']) ? $query['search'] : null }}" class="form-control input-lg">
            </div>
        </div>
        <div class="col-1" style="padding-left:1px;">
            <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat btn-block btn-md">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Data/Hora</th>
            <th scope="col">Vendedor</th>
            <th scope="col">Valor</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($budgets as $budget)
        <tr>
            <td>{{ $budget->id}}</td>
            <td>{{ $budget->customer->name }}</td>
            <td>{{ $budget->budget_date->format('d/m/Y H:i') }}</td>
            <td>{{ $budget->salesman->name }}</td>
            <td>R$ {{ $budget->price }}</td>
            <td>
                <a class="btn btn-primary btn-sm mr-2" href="{{ route('budget.edit', $budget) }}"><i class="fa fa-edit"></i></a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Não há dados a serem listados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection