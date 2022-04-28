<?php
declare(strict_types=1);

namespace Level23\Druid\HavingFilters;

class EqualToHavingFilter implements HavingFilterInterface
{
    protected string $metric;

    protected float $value;

    /**
     * EqualToHavingFilter constructor.
     *
     * @param string $metric
     * @param float  $value
     */
    public function __construct(string $metric, float $value)
    {
        $this->metric = $metric;
        $this->value  = $value;
    }

    /**
     * Return the having filter as it can be used in a druid query.
     *
     * @return array<string,string|float>
     */
    public function toArray(): array
    {
        return [
            'type'        => 'equalTo',
            'aggregation' => $this->metric,
            'value'       => $this->value,
        ];
    }
}