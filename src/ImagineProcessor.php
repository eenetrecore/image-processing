<?php

namespace Raffleometer\Image;

use Imagine\Imagick\Effects;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Imagick\Image;
use Imagine\Imagick\Imagine;

class ImagineProcessor
{
    private $imagePath;
    private $imageProcessor;
    private $image;

    public function __construct()
    {
        $this->imageProcessor = new Imagine();
    }
    public function setImage(string $imagePath)
    {
        $this->imagePath = $imagePath;
        $this->image = $this->imageProcessor->open($imagePath);
    }

    private function blurImage(int $blurSize)
    {
        $imagick = $this->image->getImagick();
        $imagick->blurImage($blurSize,8);
        $this->image = new Image($imagick);
    }
    private function resizeImage(int $height, int $width)
    {
        $this->image->resize(new Box($width, $height));
    }
    public function createBluredCover(int $blurSize, array $coverSize)
    {
        $this->resizeImage($coverSize['h'],$coverSize['w']);
        $this->blurImage($blurSize);
    }
    public function createLogo(array $logoSize)
    {
        $this->resizeImage($logoSize['h'], $logoSize['w']);
    }
    public function saveImage(string $filePath)
    {
        $this->image->save($filePath);
    }


}