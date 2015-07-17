<?php namespace SmallTeam\ImageBundle;

/**
 * Events container
 * */
abstract class Events
{

    const POST_SAVE = 'entity.post.save';

    const POST_LOAD = 'entity.post.load';

    const POST_REMOVE = 'entity.post.delete';

}