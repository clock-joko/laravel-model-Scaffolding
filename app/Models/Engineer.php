<?php

namespace App\Models;

use App\Models\Base\Engineer as BaseEngineer;
use Kyslik\ColumnSortable\Sortable;

class Engineer extends BaseEngineer
{
    use Sortable;

	protected $fillable = [
		'name',
		'email'
	];

    protected $sortable = [
        'id',
        'name',
        'email',
    ];
}
