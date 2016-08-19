<?php
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends \Illuminate\Database\Seeder{

    protected static $pool = array();

    protected $total = 50;

    public function run(){
        $this->createMultiple($this->total);
    }

    /**
     * @param $total
     */
    protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 1; $i <= $total; $i++) {
            $this->create($customValues);
        }
    }

    abstract public function getModel();
    abstract public function getDummyData(Generator $faker, array $customValues = array());

    /**
     * @param $faker
     */
    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Factory::create(), $customValues);
        $values = array_merge($values, $customValues);
        return $this->addToPool($this->getModel()->create($values));
    }

    protected function createFrom($seeder, array $customValues = array())
    {
        $seeder = new $seeder();
        return $seeder->create($customValues);
    }

    protected function getRandom($model)
    {
        $shortNameModel = $this->getShortNameEntity($model);
        if(!$this->collectionExist($shortNameModel)) {
            throw new Exception("The $shortNameModel collection does not exist");
        }
        return static::$pool[$shortNameModel]->random();
    }

    private function addToPool($entity)
    {
        $class = $this->getShortNameEntity($entity);
        if(!$this->collectionExist($class)){
            static::$pool[$class] = new Collection();
        }
        static::$pool[$class]->add($entity);
        return $entity;
    }

    /**
     * @param $class
     * @return bool
     */
    private function collectionExist($class)
    {
        return isset(static::$pool[$class]);
    }

    /**
     * @param $entity
     * @return string
     */
    private function getShortNameEntity($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();
        return $class;
    }

}