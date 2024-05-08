<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository
{
    public function __construct()
    {
    }

    /**
     * 全部資料
     *
     * @return Collection
     */
    public function query(): Collection
    {
        return Project::all();
    }

    /**
     * 新增資料
     *
     * @param array $param
     * @return Project
     */
    public function store(array $param): Project
    {
        return Project::create($param);
    }

    /**
     * 取得資料(單筆)
     *
     * @param int $id
     * @return Project
     */
    public function getById(int $id): ?Project
    {
        return Project::findOrFail($id);
    }

    /**
     * 更新資料
     *
     * @param array $param
     * @param int $id
     * @return Project
     */
    public function updateById(array $param, int $id): ?Project
    {
        $data = $this->getById($id);
        $data->fill($param);
        $data->save();

        return $data;
    }

    /**
     * 刪除資料
     *
     * @param int $id
     * @return bool
     */
    public function destroyById(int $id): ?bool
    {
        return Project::destroy($id);
    }
}
