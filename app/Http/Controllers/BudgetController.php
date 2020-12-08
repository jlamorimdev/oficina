<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use Illuminate\Http\Request;
use App\Models\{Budget, Customer, Salesman};

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
    public function index()
    {
        $budgets = $this->budget->all();
        $customers = $this->customer->all();
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

        $this->budget->create($this->validated());

        return redirect()->route('budget.index');
    }

    public function update(BudgetRequest $request)
    {

        $this->budget->update($this->validated());

        return redirect()->route('budget.index');
    }

    public function delete(Budget $budget)
    {
        $budget->delete();

        return redirect()->route('budget.index');
    }
}
