<?php

namespace Core;

use Core\Exceptions\E404;

class Model
{
	protected static string $table = '';
	protected static string $pk = 'id';

	public function __construct(protected array $fields = [])
	{
		
	}

	public static function all() : array{
		$table = static::$table;
		$rows = DB::getInstance()->query("SELECT * FROM {$table}")->fetchAll();
		return array_map(fn($row) => new static($row), $rows);
	}

	public static function find(int $id) : ?static{
		$table = static::$table;
		$pk = static::$pk;

		$row = DB::getInstance()->query(
			"SELECT * FROM {$table} WHERE {$pk}=:$pk", 
			[ ":$pk" => $id ]
		)->fetch();


		if($row === false){
			return null;
		}

		return new static($row);
	}

	public static function findOrFail(int $id) : static{
		$instance = static::find($id);

		if($instance === null){
			throw new E404();
		}

		return $instance;
	}

	public static function create($fields) {
		$table = static::$table;
		$pk = static::$pk;		
		$columns = [];
		$params = [];
		
		foreach($fields as $name => $value){
			$columns[] = $name;			
			$params[] = ":$name";
		}

		$columnsStr = implode(',', $columns);
		$paramsStr =  implode(',', $params);

		$queryStr = "INSERT INTO $table ($columnsStr) VALUES ($paramsStr)";
		
		$db = DB::getInstance();
		$db->query($queryStr, $fields);
		$fields[$pk] = $db->lastInsertId();

		return new static($fields);
	}

	public function save(){
		$table = static::$table;
		$pk = static::$pk;
		$pairs = [];
		$params = [];

		foreach($this->fields as $name => $value){
			if($name === $pk){
				$params[$pk] = $value;
			}
			else{
				$params[$name] = $value;
				$pairs[] = "$name=:$name";
			}
		}

		$pairsStr = implode(',', $pairs);
		$queryStr = "UPDATE $table SET $pairsStr WHERE $pk=:$pk";
		
		DB::getInstance()->query($queryStr, $params);
	}

	public function destroy() {
		$table = static::$table;
		$pk = static::$pk;
		$id = $this->fields[$pk];
		$queryStr = "DELETE FROM $table WHERE $pk=:$pk";		
		DB::getInstance()->query($queryStr, [ $pk => $id ]);
	}

	public static function delete(int $id) {
		$table = static::$table;
		$pk = static::$pk;
		$queryStr = "DELETE FROM $table WHERE $pk=:$pk";		
		DB::getInstance()->query($queryStr, [ $pk => $id ]);
	}

	public function refresh() : static{
		return static::find($this->fields[static::$pk]);
	}

	public function __get($name){
		return $this->fields[$name];
	}

	public function __set($name, $value){
		if($name === static::$pk){
			exit('dont change pk value, please'); //todo: Exception here
		}

		$this->fields[$name] = $value;
	}
}