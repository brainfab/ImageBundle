<?php namespace SmallTeam\ImageBundle;

use SmallTeam\Engines\ImageEngineInterface;
use Symfony\Component\Debug\Exception\ClassNotFoundException;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Image
 * */
class Image
{

    /** @var ContainerInterface */
    protected $container;

    /** @var ImageEngineInterface */
    private $engine;

    /**
     * Image constructor
     *
     * @param ContainerInterface $container
     * */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $engine_class = $this->container->getParameter('image_engine');
        $this->engine = new $engine_class;
    }

    /**
     * fitIn
     * */
    public function fitIn($source, $destination, $dimensions, $gravity = 'center')
    {
        $this->engine->fitIn($source, $destination, $dimensions, $gravity);
    }

    /**
     * fitOut
     * */
    public function fitOut($source, $destination, $dimensions, $gravity = 'center')
    {
        $this->engine->fitOut($source, $destination, $dimensions, $gravity);
    }

    /**
     * fitInFull
     * */
    public function fitInFull($source, $destination, $dimensions, $gravity = 'center', $additional_process = array())
    {
        $this->engine->fitInFull($source, $destination, $dimensions, $gravity, $additional_process);
    }

    /**
     * getImageInfo
     * */
    public function getImageInfo($path)
    {
        return $this->engine->getImageInfo($path);
    }

}