<?php

namespace Raffleometer\Image;

class ImagineProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $imageProcessor = new ImagineProcessor();
        $imageProcessor->setImage('tests/test-data/testscreen-large.jpg');
        $imageProcessor->createBluredCover(3,array('h'=>200,'w'=>150));
        $imageProcessor->saveImage('tests/test-data/testscreen-large-blured.jpg');
    }

}