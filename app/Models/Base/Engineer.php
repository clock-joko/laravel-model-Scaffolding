<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\EngineerDetail;
use App\Models\User;
use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Engineer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 *
 * @property User $user
 * @property EngineerDetail $engineer_detail
 *
 * @package App\Models\Base
 */
class Engineer extends Model
{
	use SoftDeletes;
	use AdminModelTrait;

	protected $table = 'engineers';

	protected $casts = [
		'user_id' => 'int'
	];

	public $hints = [
		'id' => 'ID',
		'name' => '名前',
		'email' => 'Email'
	];

	public $allRelations = [
		'user',
		'engineer_detail'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function engineer_detail()
	{
		return $this->hasOne(EngineerDetail::class);
	}
}
