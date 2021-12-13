<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

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
 * 
 * @property EngineerDetail $engineer_detail
 *
 * @package App\Models
 */
class Engineer extends Model
{
	use SoftDeletes;
	use AdminModelTrait;
	protected $table = 'engineers';

	protected $fillable = [
		'name',
		'email'
	];

	public $hints = [
		'id' => 'ID',
		'name' => '名前',
		'email' => 'Email'
	];

	protected $allRelations = [
		'engineer_detail'
	];

	public function engineer_detail()
	{
		return $this->hasOne(EngineerDetail::class);
	}
}
