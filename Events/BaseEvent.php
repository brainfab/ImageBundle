<?php namespace SmallTeam\ImageBundle\Events;

/**
 * BaseEvent
 * */
abstract class BaseEvent implements EventInterface
{
    /** @var object */
    protected $object;

    /**
     * BaseEvent constructor
     *
     * @param Object $object
     * */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * @inheritdoc
     * */
    public function getObject()
    {
        return $this->object;
    }
}