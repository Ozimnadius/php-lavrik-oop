<?php

class Animal
{
    /* public string $name;
    public int $health;
    public int $power; */

    public function __construct(public string $name, public int $health, public int $power)
    {
        /* $this->name = $name;
        $this->health = $health;
        $this->power = $power; */
    }

    public function isAlive()
    {
        return $this->health > 0;
    }

    public function getDamage(int $damage)
    {
        $this->health -= $damage;

        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function calcDamage(): int
    {
        return (int)($this->power * mt_rand(10, 30) / 20);
    }
}

class Dog extends Animal
{

}

class Cat extends Animal
{
    public int $lifes = 9;
    protected int $healthRestore;

    public function __construct(string $name, int $health, int $power)
    {
        parent::__construct($name, $health, $power);
        $this->healthRestore = $health;
    }

    public function getDamage(int $damage)
    {
        parent::getDamage($damage);

        if (!$this->isAlive() && $this->lifes > 1) {
            $this->lifes--;
            $this->health = $this->healthRestore;
        }
    }
}

class Mouse extends Animal
{
    protected int $hiddenLevel;

    public function __construct(string $name, int $health, int $power, int $hiddenLevel)
    {
        parent::__construct($name, $health, $power);
        $this->hiddenLevel = $hiddenLevel;
    }

    public function getDamage(int $damage)
    {
        if (mt_rand(1, 100) >= $this->hiddenLevel) {
            parent::getDamage($damage);
        }
    }
}

class GameCore
{
    protected array $animals = [];

    public function append(Animal $animal)
    {
        $this->animals[] = $animal;
    }

    public function run()
    {
        $i = 1;

        while (count($this->animals) > 1) {
            echo "<h4>Round $i</h4>";
            $this->nextRound();
            $this->animals = array_values(array_filter($this->animals, fn(Animal $animal) => $animal->isAlive()));
            $i++;
        }
    }

    protected function nextRound()
    {
        foreach ($this->animals as $animal) {
            $this->animalMove($animal);
        }
    }

    protected function animalMove(Animal $animal)
    {
        $animalWithoutCurrent = array_values(array_filter($this->animals, function (Animal $item) use ($animal) {
            return $item !== $animal;
        }));

        $t = mt_rand(0, count($animalWithoutCurrent) - 1);
        $attackTarget = $animalWithoutCurrent[$t];
        $damage = $animal->calcDamage();
        $attackTarget->getDamage($damage);
        echo "<p>{$animal->name} beat {$attackTarget->name} with power {$damage}, h={$attackTarget->health}</p>";
        /* */
    }
}

$game = new GameCore();
$game->append(new Cat('Murzik', 20, 6));
$game->append(new Cat('Kuzma', 30, 5));
$game->append(new Dog('Bobik', 200, 10));
$game->append(new Mouse('Jerry', 5, 3, 95));
$game->run();
/* $cat = new Cat('Murzik', 50, 10);
var_dump($cat->isAlive());
var_dump($cat->health);
var_dump($cat->calcDamage());
$cat->getDamage(110);
var_dump($cat->health);
var_dump($cat->lifes); */