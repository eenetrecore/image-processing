<?php

namespace Raffleometer\Image;

use Imagine\Imagick\Effects;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Imagick\Image;
use Imagine\Imagick\Imagine;

/**
 * Class ImagineProcessor
 * @package Raffleometer\Image
 */
class ImagineProcessor
{
    /**
     * @var string
     */
    private $imagePath;
    /**
     * @var Imagine
     */
    private $imageProcessor;
    /**
     * @var \Imagick
     */
    private $image;

    /**
     * ImagineProcessor constructor.
     */
    public function __construct()
    {
        $this->imageProcessor = new Imagine();
    }

    /**
     * @param string $imagePath
     */
    public function setImage(string $imagePath)
    {
        $this->imagePath = $imagePath;
        $this->image = $this->imageProcessor->open($imagePath);
    }

    /**
     * @param int $blurSize
     */
    private function blurImage(int $blurSize)
    {
        $imagick = $this->image->getImagick();
        $imagick->blurImage($blurSize,8);
        $this->image = new Image($imagick);
    }

    /**
     * @param int $height
     * @param int $width
     */
    private function resizeImage(int $height, int $width)
    {
        $this->image->resize(new Box($width, $height));
    }

    /**
     * @param int $blurSize
     * @param array $coverSize
     */
    public function createBluredCover(int $blurSize, array $coverSize)
    {
        $this->resizeImage($coverSize['h'],$coverSize['w']);
        $this->blurImage($blurSize);
    }

    /**
     * @param array $logoSize
     */
    public function createLogo(array $logoSize)
    {
        $this->resizeImage($logoSize['h'], $logoSize['w']);
    }

    /**
     * @param string $filePath
     */
    public function saveImage(string $filePath)
    {
        $this->image->save($filePath);
    }


}