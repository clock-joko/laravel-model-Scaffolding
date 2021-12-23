<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\EngineerDetail;
use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Skill
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EngineerDetail[] $engineer_details
 *
 * @package App\Models\Base
 */
class Skill extends Model
{
	use AdminModelTrait;
	protected $table = 'skills';

	public $hints = [
		'id' => 'ID',
		'name' => 'スキル名'
	];

	public $allRelations = [
		'engineer_details'
	];

	public function engineer_details()
	{
		return $this->hasMany(EngineerDetail::class);
	}
}
