<?php declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait AdminModelTrait
{
    /**
     * relationを全てwithで取得
     *
     * @return Builder
     */
    public function withAllRelation(): Builder
    {
        if ($this->allRelations) {
            return $this->with($this->allRelations);
        }
        return $this->newQuery();
    }

    /**
     * header用の名称リストを取得
     *
     * @return string[]
     */
    public function headerListScreen(): array
    {
        $headers = $this->hints;
        if ($this->allRelations) {
            foreach ($this->allRelations as $relation) {
                // ID等の重複カラムは消えるようにmergeする
                $headers = array_merge($headers, $this->$relation()->getRelated()->hints);
            }
        }

        return $headers;
    }

    /**
     * paginate付きかつ、relation全てをwithで取得
     *
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function listScreenWithPaginate(int $limit = 10): LengthAwarePaginator
    {
        return $this->withAllRelation()
            ->paginate($limit);
    }

}
