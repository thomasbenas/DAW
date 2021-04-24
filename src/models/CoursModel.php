<?php

namespace app\src\models;

use app\src\core\Model;

/**
 * CoursModel
 */
class CoursModel extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->table = "lessons";
		$this->connection();
	}
	
}