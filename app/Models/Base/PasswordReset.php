<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Traits\AdminModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * 
 * @property string $email
 * @property string $token
 * @property Carbon|null $created_at
 *
 * @package App\Models\Base
 */
class PasswordReset extends Model
{
	use AdminModelTrait;
	protected $table = 'password_resets';
	public $incrementing = false;
	public $timestamps = false;
}
