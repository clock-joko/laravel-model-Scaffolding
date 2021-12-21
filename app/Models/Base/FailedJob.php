<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FailedJob
 * 
 * @property int $id
 * @property string $uuid
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $exception
 * @property Carbon $failed_at
 *
 * @package App\Models\Base
 */
class FailedJob extends Model
{
	use AdminModelTrait;
	protected $table = 'failed_jobs';
	public $timestamps = false;

	protected $dates = [
		'failed_at'
	];
}
