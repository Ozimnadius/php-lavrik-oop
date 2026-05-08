<?php

namespace Classes;

use Traits\Log;
use Traits\NiceLog;

class User
{
	use Log, NiceLog {
		/* NiceLog::log insteadof Log; */
		Log::log insteadof NiceLog;
		NiceLog::log as niceLog;
	}

	public int $id;
	public string $name;
	protected string $role;
	protected int $sex;

	public function __construct(int $id, string $name, string $role, int $sex)
	{
		$this->id = $id;
		$this->name = $name;
		$this->role = $role;
		$this->sex = $sex;
	}

	public function isMale(){
		return $this->sex === 0;
	}

	public function isFemale(){
		return $this->sex === 1;
	}

	public function isAdmin(){
		return $this->role === 'admin';
	}

	public function defineAsAdmin(){
		$this->role = 'admin';
	}

	public function breakAdmin(){
		$this->role = 'simple';
	}
}