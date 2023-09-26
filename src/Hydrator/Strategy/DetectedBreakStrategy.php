<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\DetectedBreak;
use Laminas\Hydrator\Strategy\StrategyInterface;

class DetectedBreakStrategy implements StrategyInterface
{
    /**
     * @param DetectedBreak $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_filter([
            'type' => $value->getType(),
            'isPrefix' => $value->isPrefix(),
        ]);
    }

    /**
     * @param array $value
     * @return DetectedBreak
     */
    public function hydrate($value, ?array $data)
    {
        return new DetectedBreak($value['type'], isset($value['isPrefix']) ? $value['isPrefix'] : false);
    }
}
