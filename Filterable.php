<?php
/**
 * Created by PhpStorm.
 * User: michele.papagni
 * Date: 06/02/18
 * Time: 10:31
 */

namespace MyNamespace;

trait Filterable
{

    protected $filterableColumns = [];

    /**
     * @param $query
     */
    public function scopeFilterable($query)
    {
        $data = \Request::all();
        if (empty($data)) return;

        $filterableColumn = array_get($data, 'f', null);
        if (empty($filterableColumn) || !in_array($filterableColumn, $this->filterableColumns)) return;

        $conditionQuery = array_get($data, 'q', null);
        if (empty($conditionQuery)) return;

        $operator      = $this->getOperator($data);
        $conditionText = $this->getConditionText($operator, $conditionQuery);

        return $query->where($filterableColumn, $operator, $conditionText);
    }

    private function getConditionText($operator, $query)
    {
        switch ($operator) {
            case 'like':
                $conditionText = "%$query%";
                break;

            default:
                $conditionText = $query;
        }

        return $conditionText;
    }

    private function getOperator($data)
    {
        $operator = array_get($data, 'o', 'l');
        switch ($operator) {
            case 'l':
                $operator = 'like';
                break;
            case 'e':
                $operator = '=';
                break;
            case 'd':
                $operator = '!=';
                break;
            case 'm':
                $operator = '>';
                break;
            case 'me':
                $operator = '>=';
                break;
            case 'mi':
                $operator = '<';
                break;
            case 'mie':
                $operator = '<=';
                break;
        }

        return $operator;
    }

}