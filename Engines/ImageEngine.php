<?php namespace SmallTeam\ImageBundle\Engines;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ImageEngine
 * */
abstract class ImageEngine implements ImageEngineInterface
{
    /** @var ContainerInterface */
    private $container;

    /** @var string */
    protected $base_dir;

    /**
     * ImageEngine constructor
     *
     * @var ContainerInterface $container
     * */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->base_dir = $this->container()->getParameter('smallteam_image.base_dir');
    }

    /**
     * @inheritdoc
     * */
    public function getImageInfo($path)
    {
        if (!is_file($path)) return null;

        $last_slash = strrpos($path, '/');
        $folder     = '';
        $file       = $path;

        if ($last_slash !== false) {
            $folder = substr($path, 0, $last_slash);
            $file = substr($path, $last_slash+1);
        }
        $ext_pos    = strrpos($file, '.');
        $file_name  = $file;
        $ext        = '';
        if ($ext_pos !== false) {
            $file_name  = substr($file, 0, $ext_pos);
            $ext        = substr($file, $ext_pos);
        }

        $mess = array('b', 'Kb', 'Mb', 'Gb', 'Tb');
        $i = 0;
        $link_folder = substr($folder, mb_strlen($this->base_dir)) . '/';
        $value = array(
            'size'      => @filesize(realpath($path)),
            'is_exists' => true,
            'link'      => $link_folder.$file_name.$ext,
            'path'      => $path,
            'full_name' => $file_name.$ext,
            'name'      => $file_name,
            'ext'       => $ext
        );
        while(($i < count($mess) - 1) && ($value['size'] > 1024)) {
            $i++;
            $value['size'] = $value['size'] / 1024;
        }
        $value['size'] = ceil($value['size']).' '.$mess[$i];
        return $value;
    }

    /**
     * Get container
     *
     * @return ContainerInterface
     * */
    protected function container()
    {
        return $this->container;
    }

}