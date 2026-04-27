<?php

namespace Sample6;

use PDO;
use PDOStatement;

class DB
{
    protected PDO $db;
    protected static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=oop202304', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $this->db->exec('SET NAMES UTF8');
        var_dump('here');
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $query = $this->db->prepare($sql);
        $query->execute($params);
        $this->checkError($query);
        return $query;
    }

    public function checkError(PDOStatement $query): bool
    {
        $errInfo = $query->errorInfo();

        if ($errInfo[0] !== PDO::ERR_NONE) {
            echo $errInfo[2];
            exit();
        }

        return true;
    }
}

enum Role: int
{
    case SIMPLE = 1;
    case MANAGER = 2;
    case ADMIN = 3;
}

class User
{
    public function __construct(public int $id, public string $name, public Role $role, protected int $sex)
    {

    }

    public function isMale()
    {
        return $this->sex === 0;
    }

    public function isFemale()
    {
        return $this->sex === 1;
    }

    public function isAdmin()
    {
        return $this->role === Role::ADMIN;
    }

    public function isManager()
    {
        return $this->role === Role::MANAGER;
    }

    public function save()
    {
        DB::getInstance()->query('UPDATE users SET name=:name,role=:role,sex=:sex WHERE id=:id', [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role->value,
            'sex' => $this->sex,
        ]);
    }

    public static function load(int $id): ?static
    {
        $row = DB::getInstance()->query('SELECT * FROM users WHERE id=:id', ['id' => $id])->fetch();

        if ($row === false) {
            return null;
        }

        return new static($row['id'], $row['name'], Role::from($row['role']), $row['sex']);
    }
}


$u1 = User::load(1);
$u2 = User::load(2);
/* $u1->role = Role::ADMIN;
$u1->save(); */
var_dump($u1->isAdmin());