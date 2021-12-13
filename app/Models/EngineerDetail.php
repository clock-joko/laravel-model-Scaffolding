<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EngineerDetail
 * 
 * @property int $id
 * @property int $engineer_id
 * @property string|null $profile
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Engineer $engineer
 *
 * @package App\Models
 */
class EngineerDetail extends Model
{
	use AdminModelTrait;
	protected $table = 'engineer_details';

	protected $casts = [
		'engineer_id' => 'int'
	];

	protected $fillable = [
		'engineer_id',
		'profile'
	];

	public $hints = [
		'id' => 'ID',
		'profile' => 'プロフィール'
	];

	protected $allRelations = [
		'engineer'
	];

	public function engineer()
	{
		return $this->belongsTo(Engineer::class);
	}
}
