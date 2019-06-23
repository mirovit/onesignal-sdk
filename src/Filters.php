<?php


namespace Mirovit\OneSignal;

use Mirovit\OneSignal\Contracts\Arrayable;

/**
 * @method Filters lastSession($relation, $value)
 * @method Filters firstSession($relation, $value)
 * @method Filters sessionCount($relation, $value)
 * @method Filters sessionTime($relation, $value)
 * @method Filters amountSpent($relation, $value)
 * @method Filters boughtSku($relation, $value)
 * @method Filters language($relation, $value)
 * @method Filters appVersion($relation, $value)
 */
class Filters implements Arrayable
{
    protected $allowedFilters = [
        'last_session',
        'first_session',
        'session_count',
        'session_time',
        'amount_spent',
        'bought_sku',
        'language',
        'app_version',
    ];

    protected $filters = [];

    public function __call($name, $arguments)
    {
        $name = $this->normalizeName($name);

        if (!in_array($name, $this->allowedFilters)) {
            throw new \Exception('The field "' . $name . '" does not exist.');
        }

        $this->filters[] = $this->parseArguments(array_merge([$name], $arguments));

        return $this;
    }

    public function andWhere()
    {
        $this->filters[] = ['operator' => 'AND'];

        return $this;
    }

    public function orWhere()
    {
        $this->filters[] = ['operator' => 'OR'];

        return $this;
    }

    public function tag($key, $relation, $value = null)
    {
        $field = __FUNCTION__;

        if (is_null($value)) {
            $value = $relation;
            $relation = '=';
        }

        $this->filters[] = compact('field', 'key', 'relation', 'value');

        return $this;
    }

    public function country($value)
    {
        $field = __FUNCTION__;
        $relation = '=';
        $value = strtoupper($value);

        $this->filters[] = compact('field', 'relation', 'value');

        return $this;
    }

    public function location($radius, $lat, $long)
    {
        $field = __FUNCTION__;

        $this->filters[] = compact('field', 'radius', 'lat', 'long');

        return $this;
    }

    public function email($value)
    {
        $field = __FUNCTION__;
        $relation = '=';

        $this->filters[] = compact('field', 'relation', 'value');

        return $this;
    }

    private function parseArguments(array $arguments)
    {
        list($field, $relation, $value) = $arguments;
        $valueLabel = 'value';

        if ($field == 'last_session' || $field == 'first_session') {
            $valueLabel = 'hours_ago';
        }

        return ['field' => $field, 'relation' => $relation, $valueLabel => $value];
    }

    private function normalizeName($name)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $name, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    public function toArray()
    {
        return $this->filters;
    }
}