<?php
declare(strict_types=1);

namespace Level23\Druid\PostAggregations;

class RankPostAggregator implements PostAggregatorInterface
{
    /**
     * @var string
     */
    protected $outputName;

    /**
     * @var PostAggregatorInterface
     */
    protected $dimension;

    /**
     * @var float|int
     */
    protected $value;

    /**
     * QuantilePostAggregator constructor.
     *
     * @param PostAggregatorInterface $dimension    Post aggregator that refers to a DoublesSketch (fieldAccess or
     *                                              another post aggregator)
     * @param string                  $outputName   The name as it will be used in our result.
     * @param float|int               $value        This returns an approximation to the rank of a given value that is
     *                                              the fraction of the distribution less than that value.
     */
    public function __construct(PostAggregatorInterface $dimension, string $outputName, $value)
    {
        $this->outputName = $outputName;
        $this->dimension  = $dimension;
        $this->value      = $value;
    }

    /**
     * Return the aggregator as it can be used in a druid query.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => 'quantilesDoublesSketchToRank',
            'name'  => $this->outputName,
            'field' => $this->dimension->toArray(),
            'value' => $this->value,
        ];
    }
}