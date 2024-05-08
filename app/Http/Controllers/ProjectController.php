<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new ProjectService();
    }

    /**
     * 專案列表
     */
    public function index()
    {
        $datalist = $this->service->query();

        $binding = [
            'datalist' => $datalist,
        ];

        return view('project.index', $binding);
    }

    /**
     * 新增專案(頁)
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * 新增專案(送出)
     */
    public function store(StoreProjectRequest $request)
    {
        $input = $request->all();

        $this->service->store($input);

        return to_route('project.index');
    }

    /**
     * 檢視專案(頁)
     */
    public function show($id)
    {
        $data = $this->service->getById($id);

        $binding = [
            'view' => 'show',
            'data' => $data,
        ];

        return view('project.edit_and_show', $binding);
    }

    /**
     * 編輯專案(頁)
     */
    public function edit($id)
    {
        $data = $this->service->getById($id);

        $binding = [
            'view' => 'edit',
            'id' => $id,
            'data' => $data,
        ];

        return view('project.edit_and_show', $binding);
    }

    /**
     * 編輯專案(送出)
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $input = $request->all();

        $this->service->updateById($input, $id);

        return to_route('project.index');
    }

    /**
     * 刪除專案
     */
    public function destroy($id)
    {
        $this->service->destroyById($id);

        return to_route('project.index');
    }
}
