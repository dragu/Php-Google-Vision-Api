<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\CropHintsParams;
use Laminas\Hydrator\Strategy\StrategyInterface;

class CropHintsParamsStrategy implements StrategyInterface
{
    /**
     * @param CropHintsParams $value
     * @return array|null
     */
    public function extract($value, ?object $object = null)
    {
        return $value ? ['aspectRatios' => $value->getAspectRatios()] : null;
    }

    /**
     * @param array $value
     * @return CropHintsParams|null
     */
    public function hydrate($value, ?array $data)
    {
        return $value ? new CropHintsParams($value['aspectRatios']) : null;
    }
}
