<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Engineer;
use App\Models\Skill;
use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EngineerDetail
 * 
 * @property int $id
 * @property int $engineer_id
 * @property int $skill_id
 * @property string|null $profile
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Engineer $engineer
 * @property Skill $skill
 *
 * @package App\Models\Base
 */
class EngineerDetail extends Model
{
	use AdminModelTrait;
	protected $table = 'engineer_details';

	protected $casts = [
		'engineer_id' => 'int',
		'skill_id' => 'int'
	];

	public $hints = [
		'id' => 'ID',
		'profile' => 'プロフィール'
	];

	public $allRelations = [
		'engineer',
		'skill'
	];

	public function engineer()
	{
		return $this->belongsTo(Engineer::class);
	}

	public function skill()
	{
		return $this->belongsTo(Skill::class);
	}
}
