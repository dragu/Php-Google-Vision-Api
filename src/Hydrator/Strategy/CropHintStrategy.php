<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\CropHint;
use Laminas\Hydrator\Strategy\StrategyInterface;

class CropHintStrategy implements StrategyInterface
{
    /**
     * @var BoundingPolyStrategy
     */
    protected $boundingPolyStrategy;

    public function __construct()
    {
        $this->boundingPolyStrategy = new BoundingPolyStrategy;
    }

    /**
     * @param CropHint[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(CropHint $cropHint) {
            return array_filter([
                'boundingPoly' => $this->boundingPolyStrategy->extract($cropHint->getBoundingPoly()),
                'confidence' => $cropHint->getConfidence(),
                'importanceFraction' => $cropHint->getImportanceFraction(),
            ]);
        }, $value);
    }

    /**
     * @param array $value
     * @return CropHint[]
     */
    public function hydrate($value, ?array $data)
    {
        $cropHints = [];

        foreach ($value as $cropHintInfo) {
            $cropHints[] = new CropHint(
                $this->boundingPolyStrategy->hydrate($cropHintInfo['boundingPoly'], null),
                isset($cropHintInfo['confidence']) ? $cropHintInfo['confidence'] : null,
                isset($cropHintInfo['importanceFraction']) ? $cropHintInfo['importanceFraction'] : null
            );
        }

        return $cropHints;
    }
}
