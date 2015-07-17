<?php namespace SmallTeam\ImageBundle;

use SmallTeam\ImageBundle\Engines\ImageEngineInterface;
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
        $engine_class = $this->container->getParameter('smallteam_image.image_engine');
        $this->engine = new $engine_class;
    }

    /**
     * fitIn
     *
     * @param string $source
     * @param string $destination
     * @param string $dimensions Example: 150x150
     * @param string $gravity
     * @return void
     * */
    public function fitIn($source, $destination, $dimensions, $gravity = 'center')
    {
        $this->engine->fitIn($source, $destination, $dimensions, $gravity);
    }

    /**
     * fitOut
     *
     * @param string $source
     * @param string $destination
     * @param string $dimensions Example: 150x150
     * @param string $gravity
     * @return void
     * */
    public function fitOut($source, $destination, $dimensions, $gravity = 'center')
    {
        $this->engine->fitOut($source, $destination, $dimensions, $gravity);
    }

    /**
     * fitInFull
     *
     * @param string $source
     * @param string $destination
     * @param string $dimensions Example: 150x150
     * @param string $gravity
     * @param array $additional_process
     * @return void
     * */
    public function fitInFull($source, $destination, $dimensions, $gravity = 'center', $additional_process = array())
    {
        $this->engine->fitInFull($source, $destination, $dimensions, $gravity, $additional_process);
    }

    /**
     * getImageInfo
     *
     * @param string $path
     * @return null|array
     * */
    public function getImageInfo($path)
    {
        return $this->engine->getImageInfo($path);
    }

}