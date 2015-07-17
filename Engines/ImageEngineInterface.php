<?php namespace SmallTeam\ImageBundle\Engines;

/**
 * ImageEngineInterface
 * */
interface ImageEngineInterface
{

    /**
     * fitIn
     * */
    public function fitIn($source, $destination, $dimensions, $gravity);

    /**
     * fitOut
     * */
    public function fitOut($source, $destination, $dimensions, $gravity);

    /**
     * fitInFull
     * */
    public function fitInFull($source, $destination, $dimensions, $gravity, $additional_process);

    /**
     * Get image info
     * */
    public function getImageInfo($path);

}