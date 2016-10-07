<?php

namespace Raffleometer\Image;


use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class PrepareImages
 * @package Raffleometer\Image
 */
class PrepareImages
{
    private $config;
    private $image_processor;

    /**
     * PrepareImages constructor.
     * @param string $configLocation configuration location
     */
    public function __construct(string $configLocation, ImagineProcessor $imagineProcessor)
    {
        $this->readConfiguration($configLocation);
        $this->createDirectoryStructure();
        $this->image_processor = $imagineProcessor;
    }

    /**
     * Creates directory structure from the configuration
     */
    private function createDirectoryStructure()
    {
        $dir = array(
            $this->config['users-logo']['location']['path'],
            $this->config['event']['cover']['location']['path'],
            $this->config['event']['small']['location']['path'],
            $this->config['non-profit-logo']['small']['location']['path'],
            $this->config['non-profit-logo']['large']['location']['path']
        );
        foreach($dir as $directory) {
            if (file_exists($directory)) {
                continue;
            }
            if (!mkdir($directory, 0777, true)) {
                new Exception('Failed to create directory: ' . $directory);
            }
        }
    }

    /**
     * @param string $configFullPath
     */
    private function readConfiguration(string $configFullPath)
    {
        $this->config = yaml_parse_file($configFullPath);
    }

    /**
     * @param string $fileFullPath
     * @return string
     */
    private function getFilename(string $fileFullPath):string
    {
        $baseName = pathinfo($fileFullPath);
        return $baseName['filename'];
    }

    /**
     * @return array
     */
    public function getConfiguration():array
    {
        return $this->config;
    }

    public function processNonProfitImages(string $largeImage, string $smallImage)
    {
        $this->image_processor->setImage($smallImage);
        $this->image_processor->createLogo(
            array(
                'h' => $this->config['non-profit-logo']['small']['size']['height'],
                'w' => $this->config['non-profit-logo']['small']['size']['width']
            )
        );
        $this->image_processor->saveImage(
            $this->config['non-profit-logo']['small']['location']['path'].
            '/'.$this->getFilename($smallImage).'.png'
        );

        $this->image_processor->setImage($largeImage);
        $this->image_processor->createLogo(
            array(
                'h' => $this->config['non-profit-logo']['large']['size']['height'],
                'w' => $this->config['non-profit-logo']['large']['size']['width']
            )
        );
        $this->image_processor->saveImage(
            $this->config['non-profit-logo']['large']['location']['path'].
            '/'.$this->getFilename($largeImage).'.png'
        );

    }

    /**
     * Creates event images required by the Raffleometer
     * @param string $imagePath
     */
    public function processEventImage(string $imagePath)
    {
        /**
         * create logo image for the event
         */
        $this->image_processor->setImage($imagePath);
        $this->image_processor->createLogo(
            array(
                'h' => $this->config['event']['small']['size']['height'],
                'w' => $this->config['event']['small']['size']['width']
            )
        );
        $this->image_processor->saveImage(
            $this->config['event']['small']['location']['path'].
            '/'.$this->getFilename($imagePath).'.png'
        );
        /**
         * Create cover image for event
         */
        $this->image_processor->setImage($imagePath);
        $this->image_processor->createBluredCover(
            $this->config['event']['cover']['blur-size'],
            array(
                'h' => $this->config['event']['cover']['size']['height'],
                'w' => $this->config['event']['cover']['size']['width']
            )
        );
        $this->image_processor->saveImage(
            $this->config['event']['cover']['location']['path'].
            '/'.$this->getFilename($imagePath).'.png'
        );
    }

    /**
     * Creates user logo image required by the Raffleometer
     * @param string $imagePath
     */
    public function processUserImage(string $imagePath)
    {
        $this->image_processor->setImage($imagePath);
        $this->image_processor->createLogo(
            array(
                'h' => $this->config['users-logo']['size']['height'],
                'w' => $this->config['users-logo']['size']['width']
            )
        );
        $this->image_processor->saveImage(
            $this->config['users-logo']['location']['path'].
            '/'.$this->getFilename($imagePath).'.png'
        );
    }
}