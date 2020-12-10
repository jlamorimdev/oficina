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
            <label class="mr-3">
                De:
                <input type="date" name="start" value="{{ !empty($query['start']) ? $query['start'] : null }}">
            </label>
            <label class="mr-3">
                Até:
                <input type="date" name="end" value="{{ !empty($query['end']) ? $query['end'] : null }}">
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