<?php namespace SmallTeam\ImageBundle\EventListeners;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use SmallTeam\ImageBundle\Image;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DoctrineListener implements EventSubscriber
{
    /** @var ContainerInterface */
    protected $container;

    /** @var Image */
    protected $engine;

    /**
     * @param ContainerInterface $container
     * */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->engine = $container->get('image');
    }

    /**
     * @inheritdoc
     * */
    public function getSubscribedEvents()
    {
        return array(
            'postPersist' => 'postSave',
            'postUpdate' => 'postSave',
            'postLoad' => 'postLoad',
            'postRemove' => 'postRemove',
        );
    }

    public function postSave(LifecycleEventArgs $args)
    {
        $object = $this->getObjectFromArgs($args);
        $settings = $this->getImagesSettings($object);

        if(!$settings) {
            return;
        }

        $base_dir = $this->container->get('smallteam_image.base_dir');
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $object = $this->getObjectFromArgs($args);
        $settings = $this->getImagesSettings($object);

        if(!$settings) {
            return;
        }
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $object = $this->getObjectFromArgs($args);
        $settings = $this->getImagesSettings($object);

        if(!$settings) {
            return;
        }
    }

    protected function getObjectFromArgs(LifecycleEventArgs $args)
    {
        return $args->getEntity();
    }

    protected function getImagesSettings($object)
    {
        if(is_object($object) && method_exists($object, 'getImagesSettings')) {
            return call_user_func($object, 'getImagesSettings');
        }

        return null;
    }

}