<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Collection;

class ProjectService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProjectRepository();
    }

    /**
     * 全部資料
     *
     * @return Project
     */
    public function query(): Collection
    {
        return $this->repository->query();
    }

    /**
     * 新增資料
     *
     * @param array $param
     * @return Project
     */
    public function store(array $param): Project
    {
        return $this->repository->store($param);
    }

    /**
     * 取得資料(單筆)
     *
     * @param int $id
     * @return Project
     */
    public function getById(int $id): ?Project
    {
        return $this->repository->getById($id);
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
        return $this->repository->updateById($param, $id);
    }

    /**
     * 刪除資料
     *
     * @param int $id
     * @return bool
     */
    public function destroyById(int $id): ?bool
    {
        return $this->repository->destroyById($id);
    }
}
