<form method="post" action="{{ route('budget.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Cliente:
        </label>
        <select name="customer_id" class="form-control">
            <option value="" disabled selected>Selecione um cliente</option>
            @foreach($customers as $customer)
                <option {{ old('customer_id') == $customer->id || (!empty($budget) && $budget->customer_id == $customer->id) ? 'selected' : null }} value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
        @if($errors->has('customer_id'))
            <div class="text-danger">
                {{ $errors->first('customer_id') }}
            </div>
        @endif
    </div>
    <div class="form-group {{ $errors->has('salesman_id') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Vendedor:
        </label>
        <select name="salesman_id" class="form-control">
            <option value="" disabled selected>Selecione um vendedor</option>
            @foreach($salesmen as $salesman)
                <option {{ old('salesman_id') == $salesman->id || (!empty($budget) && $budget->salesman_id == $salesman->id) ? 'selected' : null }} value="{{ $salesman->id }}">{{ $salesman->name }}</option>
            @endforeach
        </select>
        @if($errors->has('salesman_id'))
            <div class="text-danger">
                {{ $errors->first('salesman_id') }}
            </div>
        @endif
    </div>
    <div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Descrição:
            <small>( Até 155 caracteres )</small>
        </label>
        <textarea rows="2" name="description" class="form-control" placeholder="Informe a descrição">{{ old('description') ?? $budget->description ?? null }}</textarea>
        @if($errors->has('description'))
            <div class="text-danger">
                {{ $errors->first('description') }}
            </div>
        @endif
    </div>
    <div class="form-group {{ $errors->has('budget_date') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Valor do orçamento:
        </label>
        <input type="datetime-local" name="budget_date" class="form-control col-md-2" value="{{ (old('budget_date') ? old('budget_date') : (!empty($budget) ? $budget->budget_date->format('Y-m-d\\TH:i') : now()->format('Y-m-d\\TH:i'))) }}">
        @if($errors->has('budget_date'))
            <div class="text-danger">
                {{ $errors->first('budget_date') }}
            </div>
        @endif
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Valor do orçamento:
        </label>
        <input type="text" name="price" class="form-control col-md-2" placeholder="R$ 00.00" value="{{ old('price') ?? $budget->price ?? null }}">
        @if($errors->has('price'))
            <div class="text-danger">
                {{ $errors->first('price') }}
            </div>
        @endif
    </div>
    </div>
    <button class="btn btn-primary">Salvar</button>
    @if(!empty($budget))
        <button type="button" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-flat"><i class="{{ config('style.icons.actions.delete') }}"></i> Deletar</button>
    @endif
</form>

@if(!empty($budget))
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Deseja deletar esse Orçamento?</h4>
                </div>
                <div class="modal-footer">
                    <form method="POST" class="form-inline" action="{{ route('budget.delete', $budget) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-success btn-flat"><i class="fa fa-check"></i> Sim</button>
                    </form>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Não</button>
                </div>
            </div>
        </div>
    </div>
@endif