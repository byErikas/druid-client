<?php
declare(strict_types=1);

namespace Level23\Druid\PostAggregations;

class QuantilesPostAggregator implements PostAggregatorInterface
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
     * @var float[]
     */
    protected $fractions;

    /**
     * QuantilesPostAggregator constructor.
     *
     * @param PostAggregatorInterface $dimension    Post aggregator that refers to a DoublesSketch (fieldAccess or
     *                                              another post aggregator)
     * @param string                  $outputName   The name as it will be used in our result.
     * @param float[]                 $fractions    array of fractional positions in the hypothetical sorted stream,
     *                                              number from 0 to 1 inclusive
     */
    public function __construct(PostAggregatorInterface $dimension, string $outputName, array $fractions)
    {
        $this->outputName = $outputName;
        $this->dimension  = $dimension;
        $this->fractions  = $fractions;
    }

    /**
     * Return the aggregator as it can be used in a druid query.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'      => 'quantilesDoublesSketchToQuantiles',
            'name'      => $this->outputName,
            'field'     => $this->dimension->toArray(),
            'fractions' => $this->fractions,
        ];
    }
}