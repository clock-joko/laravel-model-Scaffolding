<?php

namespace App\Models;

use App\Models\Base\Engineer as BaseEngineer;

class Engineer extends BaseEngineer
{
	protected $fillable = [
		'name',
		'email'
	];
}
