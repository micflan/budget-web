<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Services\Budget as BudgetService;
use Illuminate\Http\Request;
use App\Http\Requests;

class Budget extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function create(BudgetRequest $request)
    {
        $start = \DateTime::createFromFormat('Y-m-d', $request->get('start-date'));
        $end = \DateTime::createFromFormat('Y-m-d', $request->get('end-date'));
        $cash = (float) $request->get('cash');

        $budget = BudgetService::create($start, $end, $cash);

        return redirect()->action('Budget@show', [$budget->getKey()]);
    }

    public function show(string $key)
    {
        $budget = BudgetService::load($key);

        return view('budget')->with(['budget' => $budget, 'key' => $key]);
    }

    public function spend(Request $request, string $key)
    {
        $value = $request->get('value');
        $date = new \DateTime($request->get('date', 'now'));

        $budget = BudgetService::load($key);
        $budget->spend($value, $date);

        BudgetService::save($budget);

        return redirect()->action('Budget@show', [$key]);
    }

    public function load(Request $request)
    {
        return redirect()->action('Budget@show', [$request->get('key')]);
    }
}
