<?php

namespace Raffleometer\Image;


class ImageReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests image reader construct
     */
    public function testConstruct()
    {
        $imagePreparation = new ImageReader("conf/image-read.yml");
        $test_value = $imagePreparation->getConfiguration();
        $expected_value = yaml_parse_file('conf/image-read.yml');
        $this->assertEquals($expected_value, $test_value);
    }

    /**
     * Tests is the correct path returned for the user logo image
     */
    public function testUserLogoGet()
    {
        $imageReader = new ImageReader("conf/image-read.yml");

        $this->assertEquals(
            'tests/test-data/image-test/users/logo/user-test-image.png',
            $imageReader->getUserLogo('user-test-image.png')
        );
    }

    /**
     * Tests is the correct path returned for the event cover
     */
    public function testEventCoverGet()
    {
        $imageReader = new ImageReader("conf/image-read.yml");

        $this->assertEquals(
            'tests/test-data/image-test/event/cover/event-test-image.png',
            $imageReader->getEventCover('event-test-image.png')
        );
    }

    /**
     * Tests is the correct path returned for the event logo
     */
    public function testEventLogoGet()
    {
        $imageReader = new ImageReader("conf/image-read.yml");

        $this->assertEquals(
            'tests/test-data/image-test/event/small/event-test-image.png',
            $imageReader->getEventLogo('event-test-image.png')
        );
    }

    /**
     * Tests is the correct path returned for the non profit large
     */
    public function testNonProfitLogoLargeGet()
    {
        $imageReader = new ImageReader("conf/image-read.yml");

        $this->assertEquals(
            'tests/test-data/image-test/non-profit/logo/large/test-screen-large.png',
            $imageReader->getNonProfitLargeLogo('test-screen-large.png')
        );
    }



    /**
     * Tests is the correct path returned for the non profit small logo
     */
    public function testNonProfitLogoSmallGet()
    {
        $imageReader = new ImageReader("conf/image-read.yml");

        $this->assertEquals(
            'tests/test-data/image-test/non-profit/logo/small/test-image.png',
            $imageReader->getNonProfitSmallLogo('test-image.png')
        );
    }
}