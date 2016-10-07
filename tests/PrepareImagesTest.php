<?php

namespace Raffleometer\Image;

/**
 * Class PrepareImagesTest
 * @package Raffleometer\Image
 */
class PrepareImagesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing constructor and config readout
     */
    public function testConstructor()
    {
        $imageProcessor = new ImagineProcessor();
        $imagePreparation = new PrepareImages("conf/image-prep.yml", $imageProcessor);
        $test_value = $imagePreparation->getConfiguration();
        $expected_value = yaml_parse_file('conf/image-prep.yml');
        $this->assertEquals($expected_value, $test_value);
    }

    /**
     * Testing non profit image processing
     */
    public function testNonProfitImagePrep()
    {
        $imageProcessor = new ImagineProcessor();
        $imagePreparation = new PrepareImages("conf/image-prep.yml", $imageProcessor);
        $imagePreparation->processNonProfitImages('tests/test-data/testscreen-large.jpg','tests/test-data/test-image.png');
    }

    /**
     * Testing event image processing
     */
    public function testEventImagePrep()
    {
        $imageProcessor = new ImagineProcessor();
        $imagePreparation = new PrepareImages("conf/image-prep.yml", $imageProcessor);
        $imagePreparation->processEventImage('tests/test-data/event-test-image.jpg');
    }

    /**
     * test user image processing
     */
    public function testUserImagePrep()
    {
        $imageProcessor = new ImagineProcessor();
        $imagePreparation = new PrepareImages("conf/image-prep.yml", $imageProcessor);
        $imagePreparation->processUserImage('tests/test-data/user-test-image.png');
    }
}