<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\{Budget, Customer, Salesman};
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private $budget;
    private $customer;
    private $salesman;

    public function __construct(Budget $budget, Customer $customer, Salesman $salesman)
    {
        $this->budget = $budget;
        $this->customer = $customer;
        $this->salesman = $salesman;
    }
    public function index(Request $request)
    {
        $budgets = $this->budget->latest();

        if ($request->filled('start')) {
            $budgets->whereDate('budget_date', '>=', $request->query('start'));
        }

        if ($request->filled('end')) {
            $budgets->whereDate('budget_date', '<=', $request->query('end'));
        }

        $budgets->where(function ($query) use ($request) {

            $search = $request->query('search');

            if (request()->get('customer')) {
                $query->orWhereHas('customer', function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }

            if (request()->get('salesman')) {
                $query->orWhereHas('salesman', function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%');
                });
            }
        });

        $customers = $this->customer->all();
        $budgets = $budgets->get();
        $salesmen = $this->salesman->all();

        return view('budgets.view', compact('budgets', 'customers', 'salesmen'));
    }

    public function create()
    {
        $customers = $this->customer->all();
        $salesmen = $this->salesman->all();

        return view('budgets.create', compact('customers', 'salesmen'));
    }

    public function edit(Budget $budget)
    {
        $customers = $this->customer->all();
        $salesmen = $this->salesman->all();

        return view('budgets.edit', compact('budget', 'customers', 'salesmen'));
    }

    public function store(BudgetRequest $request)
    {
        $this->budget->create($request->validated());

        Alert::toast('Orçamento cadastrado com sucesso', 'success');
        return redirect()->route('budget.index');
    }

    public function update(BudgetRequest $request)
    {

        $this->budget->update($request->validated());

        Alert::toast('Orçamento editado com sucesso', 'success');
        return redirect()->route('budget.index');
    }

    public function delete(Budget $budget)
    {
        $budget->delete();

        Alert::toast('Orçamento deletado com sucesso', 'success');
        return redirect()->route('budget.index');
    }
}
