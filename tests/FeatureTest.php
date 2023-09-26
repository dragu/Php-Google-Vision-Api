<?php

namespace Vision\Tests\Hydrator\Strategy;

use PHPUnit\Framework\TestCase;
use Vision\Feature;

class FeatureTest extends TestCase
{
    public function testShouldDisallowUnknownFeature()
    {
        $this->expectException(\Vision\Exception\UnknownFeatureException::class);

        new Feature('Unknown feature', 12);
    }
}
