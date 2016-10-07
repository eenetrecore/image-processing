<?php

namespace Raffleometer\Image;


class ImageReader
{
    /**
     * @var string configuration file location
     */
    private $configPath = '';
    /**
     * @var array configuration array;
     */
    private $config=array();

    public function __construct(string $configPath)
    {
        $this->configPath = $configPath;
        $this->readConfiguration();
    }

    /**
     * Configuration reader
     */
    private function readConfiguration()
    {
        $this->config = yaml_parse_file($this->configPath);
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->config;
    }
    /**
     * Returns event cover photo
     * @param string $filename
     * @return string
     */
    public function getEventCover(string$filename):string
    {
        return $this->config['event']['cover']['location']['path'].'/'.$filename;
    }

    /**
     * Returns event logo
     * @param string $filename
     * @return string
     */
    public function getEventLogo(string $filename):string
    {
        return $this->config['event']['small']['location']['path'].'/'.$filename;
    }

    /**
     * Return user logo image
     * @param string $filename
     * @return string
     */
    public function getUserLogo(string $filename):string
    {
        return $this->config['users-logo']['location']['path'].'/'.$filename;
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getNonProfitLargeLogo(string $filename):string
    {
        return $this->config['non-profit-logo']['large']['location']['path'].'/'.$filename;
    }

    /**
     * @param string $filename
     * @return string
     */
    public function getNonProfitSmallLogo(string $filename):string
    {
        return $this->config['non-profit-logo']['small']['location']['path'].'/'.$filename;
    }
}