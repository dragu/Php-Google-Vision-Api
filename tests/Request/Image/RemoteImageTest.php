<?php

namespace Vision\Tests\Request\Image;

use PHPUnit\Framework\TestCase;
use Vision\Request\Image\RemoteImage;

class RemoteImageTest extends TestCase
{
    public function testValueIsArray()
    {
        $remoteImage = new RemoteImage('test');

        $value = $remoteImage->getValue();
        $this->assertArrayHasKey('imageUri',$value);
        $this->assertEquals('test', $value['imageUri']);
    }
}
