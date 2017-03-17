<?php

namespace App\Services;

use App\Budget as EloquentBudget;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Trixworks\Budget\Entities\Budget as TrixworksBudget;
use Trixworks\Budget\Entities\DateRange;
use Trixworks\Budget\Entities\Expense;
use Illuminate\Support\Facades\Crypt;

class Budget
{
    /**
     * @param $start
     * @param $end
     * @param $cash
     * @return TrixworksBudget
     */
    public static function create($start, $end, $cash)
    {
        if (! is_a($start, DateTime::class)) {
            $start = new DateTime($start);
        }

        if (! is_a($end, DateTime::class)) {
            $end = new DateTime($end);
        }

        $budget = new TrixworksBudget(new DateRange($start, $end), $cash);

        EloquentBudget::create([
            'start' => $budget->startDate(),
            'end' => $budget->endDate(),
            'key' => $budget->getKey(),
            'cash' => $budget->startingCash(),
        ]);

        return $budget;
    }

    /**
     * @param string $key
     * @return TrixworksBudget
     */
    public static function load(string $key)
    {
        if (! $db = EloquentBudget::with('expenses')->where('key', sha1($key))->first())
        {
            abort(404);
        }

        $budget = new TrixworksBudget(new DateRange($db->start, $db->end), $db->cash);
        $budget->setKey($key);

        foreach ($db->expenses as $expense)
        {
            $budget->spend($expense->value, $expense->date);
        }

        $budget->process();

        return $budget;
    }

    /**
     * @param TrixworksBudget $budget
     * @return TrixworksBudget
     */
    public static function save(TrixworksBudget $budget)
    {
        if (! $db = EloquentBudget::with('expenses')->where('key', sha1($budget->getKey()))->first())
        {
            $db = EloquentBudget::create([
                'start' => $budget->startDate(),
                'end' => $budget->endDate(),
                'key' => $budget->getKey(),
                'cash' => $budget->startingCash()
            ]);
        }

        $expenses = array_filter($budget->expenses()->all(), function(Expense $expense) {
            return $expense->isNew();
        });

        /** @var Expense $expense */
        foreach ($expenses as $expense) {
            $db->expenses()->create([
                'date' => $expense->date(),
                'value' => $expense->value()
            ]);

            $expense->process();
        }

        return $budget;
    }
}