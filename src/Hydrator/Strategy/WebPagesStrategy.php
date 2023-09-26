<?php

namespace Vision\Hydrator\Strategy;

use Vision\Annotation\Property;
use Vision\Annotation\WebPage;
use Laminas\Hydrator\Strategy\StrategyInterface;

class WebPagesStrategy implements StrategyInterface
{
    /**
     * @param WebPage[] $value
     * @return array
     */
    public function extract($value, ?object $object = null)
    {
        return array_map(function(WebPage $webPage) {
            return array_filter([
                'url' => $webPage->getUrl(),
                'score' => $webPage->getScore(),
            ]);
        }, $value);
    }

    /**
     * @param array $value
     * @return WebPage[]
     */
    public function hydrate($value, ?array $data)
    {
        $webPages = [];

        foreach ($value as $webPageInfo) {
            $webPages[] = new WebPage($webPageInfo['url'], isset($webPageInfo['score']) ? $webPageInfo['score'] : null);
        }

        return $webPages;
    }
}
