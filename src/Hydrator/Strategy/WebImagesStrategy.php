<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\WebImage;
use Laminas\Hydrator\Strategy\StrategyInterface;

class WebImagesStrategy implements StrategyInterface
{
    /**
     * @param WebImage[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(WebImage $webImage) {
            return array_filter([
                'url' => $webImage->getUrl(),
                'score' => $webImage->getScore(),
            ]);
        }, $value);
    }

    /**
     * @param array $value
     * @return WebImage[]
     */
    public function hydrate($value, ?array $data)
    {
        $webImages = [];

        foreach ($value as $webImageInfo) {
            $webImages[] = new WebImage($webImageInfo['url'], isset($webImageInfo['score']) ? $webImageInfo['score'] : null);
        }

        return $webImages;
    }
}
