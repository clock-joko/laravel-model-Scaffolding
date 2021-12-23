<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Engineer;
use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Engineer $engineer
 *
 * @package App\Models\Base
 */
class User extends Model
{
	use AdminModelTrait;
	protected $table = 'users';

	protected $dates = [
		'email_verified_at'
	];

	public $allRelations = [
		'engineer'
	];

	public function engineer()
	{
		return $this->hasOne(Engineer::class);
	}
}
