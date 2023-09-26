<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\CropHintsParams;
use Vision\Annotation\WebDetectionParams;
use Laminas\Hydrator\Strategy\StrategyInterface;

class WebDetectionParamsStrategy implements StrategyInterface
{
    /**
     * @param WebDetectionParams $value
     * @return array|null
     */
    public function extract($value, ?object $object = null)
    {
        return $value ? ['includeGeoResults' => !!$value->isIncludeGeoResults()] : null;
    }

    /**
     * @param array $value
     * @return WebDetectionParams|null
     */
    public function hydrate($value, ?array $data)
    {
        return $value ? new WebDetectionParams(!!$value['includeGeoResults']) : null;
    }
}
