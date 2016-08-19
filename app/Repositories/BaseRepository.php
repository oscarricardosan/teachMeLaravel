<?php
/**
 * Created by PhpStorm.
 * User: masterdev
 * Date: 16/08/2016
 * Time: 22:36
 */

namespace TeachMe\Repositories;


/**
 * Class BaseRepository
 * @package TeachMe\Repositories
 */
abstract class BaseRepository
{
    /**
     * return \TeachMe\Entities\Entity
     */
    abstract public function getEntity();


    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->getEntity()->newQuery();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }
}