<?php

namespace App\Models;

use App\Models\Base\EngineerDetail as BaseEngineerDetail;

class EngineerDetail extends BaseEngineerDetail
{
	protected $fillable = [
		'engineer_id',
		'profile'
	];
}
