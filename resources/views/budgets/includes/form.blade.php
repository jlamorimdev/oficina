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
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
            <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
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
        <textarea rows="2" name="description" class="form-control" placeholder="Informe a descrição"></textarea>
        @if($errors->has('description'))
        <div class="text-danger">
            {{ $errors->first('description') }}
        </div>
        @endif
    </div>
    <div class="form-group {{ $errors->has('price') ? 'has-error' : null }}">
        <label>
            <small class="text-danger">*</small>
            Valor do orçamento:
        </label>
        <input type="text" name="price" class="form-control col-md-2" placeholder="R$ 00.00">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirma que deseja deletar esse Orçamento?</h4>
            </div>
            <div class="modal-footer">
                <form method="POST" class="form-inline pull-left" action="{{ route('budget.delete', $budget) }}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-success btn-flat"><i class="fa fa-check"></i> Sim</button>
                </form>
                <button type="button" class="btn btn-danger btn-flat pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Não</button>
            </div>
        </div>
    </div>
</div>
@endif