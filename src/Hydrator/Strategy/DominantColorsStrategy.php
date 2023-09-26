<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\Color;
use Vision\Annotation\DominantColor;
use Laminas\Hydrator\Strategy\StrategyInterface;

class DominantColorsStrategy implements StrategyInterface
{
    /**
     * @param DominantColor[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        $colorMap = array_map(function(DominantColor $dominantColor) {
            return [
                'color' => [
                    'red' => $dominantColor->getColor()->getRed(),
                    'green' => $dominantColor->getColor()->getGreen(),
                    'blue' => $dominantColor->getColor()->getBlue(),
                ],
                'score' => $dominantColor->getScore(),
                'pixelFraction' => $dominantColor->getPixelFraction(),
            ];
        }, $value);

        return ['colors' => $colorMap];
    }

    /**
     * @param array $value
     * @return DominantColor[]
     */
    public function hydrate($value, ?array $data)
    {
        $dominantColors = [];

        foreach ($value['colors'] as $colorInfo) {
            $dominantColor = new DominantColor();

            $colorArray = $colorInfo['color'];
            $color = new Color($colorArray['red'], $colorArray['green'], $colorArray['blue']);

            $dominantColor->setColor($color);
            $dominantColor->setPixelFraction($colorInfo['pixelFraction']);
            $dominantColor->setScore($colorInfo['score']);

            $dominantColors[] = $dominantColor;
        }

        return $dominantColors;
    }
}
