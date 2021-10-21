<?php

namespace ColorThief\Image\Adapter\Test;

use ColorThief\Image\Adapter\ImagickImageAdapter;
use Imagick;

/**
 * @requires extension imagick
 */
class ImagickImageAdapterTest extends BaseImageAdapterTest
{
    protected function getTestResourceInstance()
    {
        // The loader requires a non-empty Imagick object for the color space check
        return new Imagick(__DIR__ . '/../../images/blank.png');
    }

    protected function getAdapterInstance()
    {
        return new ImagickImageAdapter();
    }

    protected function checkIsLoaded($adapter)
    {
        // Checks object state
        $image = $adapter->getResource();
        $this->assertInstanceOf('\Imagick', $image);
        $this->assertTrue($image->valid());
    }

    public function testLoadInvalidArgument()
    {
        $this->expectException('\InvalidArgumentException');
        $this->expectExceptionMessage('Passed variable is not an instance of Imagick');

        // We want to check also the specific exception message.
        parent::testLoadInvalidArgument();
    }

    public function testLoadFileWebp()
    {
        if (empty(Imagick::queryFormats('WEBP'))) {
            $this->markTestSkipped('Imagick was not compiled with support for WebP format.');
        }

        return parent::testLoadFileWebp();
    }
}
