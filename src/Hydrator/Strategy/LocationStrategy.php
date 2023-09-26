<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\LatLng;
use Vision\Annotation\Location;
use Laminas\Hydrator\Strategy\StrategyInterface;

class LocationStrategy implements StrategyInterface
{
    /**
     * @param Location[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(Location $location) {
            return [
                'latLng' => [
                    'latitude' => $location->getLatLng()->getLatitude(),
                    'longitude' => $location->getLatLng()->getLongitude()
                ]
            ];
        }, $value);
    }

    /**
     * @param array $value
     * @return Location[]
     */
    public function hydrate($value, ?array $data)
    {
        $locations = [];

        foreach ($value as $locationInfo) {
            $latLng = $locationInfo['latLng'];
            $locations[] = new Location(new LatLng($latLng['latitude'], $latLng['longitude']));
        }

        return $locations;
    }
}
