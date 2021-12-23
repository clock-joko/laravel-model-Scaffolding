<?php declare(strict_types=1);

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait AdminModelTrait
{
    /**
     * relation先全てを含むhintsを取得
     *
     * @return string[]
     */
    public function allRelationsHints(): array
    {
        $headers = $this->hints ?? [];
        $prefix = Str::snake(str_replace('App\Models\\', '', $this->getMorphClass()));
        foreach ($headers as $key => $header) {
            $headers[$prefix . '.' . $key] = $header;
            unset($headers[$key]);
        }
        if ($this->allRelations) {
            $childHints = self::recursionHints($this, $this->allRelations);
            $headers = array_merge($headers, $childHints);
        }

        return $headers;
    }

    /**
     * 再帰的にrelation先のhintsを取得
     *
     * @param $class
     * @param array $relations
     * @return array
     */
    private function recursionHints($class, array $relations): array
    {
        $result = [];
        foreach ($relations as $relation) {
            $hints = $class->$relation()->getRelated()->hints ?? [];
            foreach ($hints as $key => $hint) {
                $hints[$relation . '.' . $key] = $hint;
                unset($hints[$key]);
            }
            $result = array_merge($result, $hints);

            $childRelations = $class->$relation()->getRelated()->allRelations;
            foreach ($childRelations as $index => $childRelation) {
                if (get_class($class->$relation()->getRelated()->$childRelation()->getRelated()) === get_class($class)) {
                    unset($childRelations[$index]);
                } else {
                    $hints = $class->$relation()->getRelated()->$childRelation()->getRelated()->hints ?? [];
                    foreach ($hints as $key => $hint) {
                        $hints[$childRelation . '.' . $key] = $hint;
                        unset($hints[$key]);
                    }
                    $result = array_merge($result, $hints);
                }
            }
            if ($childRelations) {
                $grandchildRelationHints = self::recursionHints($class->$relation()->getRelated(), $childRelations);
                if ($grandchildRelationHints) {
                    $result = array_merge($result, $grandchildRelationHints);
                }
            }
        }

        return $result;
    }

    /**
     * relationを全てwithで取得
     *
     * @return Builder
     */
    public function withAllRelation(): Builder
    {
        if ($this->allRelations) {
            $childRelations = self::recursionRelations($this, $this->allRelations);
            $relations = array_merge($this->allRelations, $childRelations);
            return $this->with($relations);
        }
        return $this->newQuery();
    }

    /**
     * 再帰的にrelationを取得
     *
     * @param $class
     * @param array $relations
     * @return array
     */
    private function recursionRelations($class, array $relations): array
    {
        $result = [];
        foreach ($relations as $relation) {
            $childRelations = $class->$relation()->getRelated()->allRelations;
            foreach ($childRelations as $index => $childRelation) {
                if (get_class($class->$relation()->getRelated()->$childRelation()->getRelated()) === get_class($class)) {
                    unset($childRelations[$index]);
                }
            }
            if ($childRelations) {
                $format = array_map(function ($data) use ($relation) {
                    return $relation . '.' . $data;
                }, $childRelations);
                $result = array_merge($result, $format);
                $grandchildRelations = self::recursionRelations($class->$relation()->getRelated(), $childRelations);
                if ($grandchildRelations) {
                    $format = array_map(function ($data) use ($relation) {
                        return $relation . '.' . $data;
                    }, $grandchildRelations);
                    $result = array_merge($result, $format);
                }
            }
        }

        return $result;
    }

    /**
     * paginate付きかつ、relation全てをwithで取得
     *
     * @param int $limit
     * @param bool $isSortable
     * @return LengthAwarePaginator
     */
    public function listScreenWithPaginate(int $limit = 10, bool $isSortable = false): LengthAwarePaginator
    {
        $query = $this->withAllRelation();
        if ($isSortable && $this->sortable) {
            $query->sortable();
        }

        return $query
            ->paginate($limit);
    }

}
