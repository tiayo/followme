<?php

namespace App\Repositories;

use App\Manager;

class ManagerRepository
{
    protected $manager;
    protected $num;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
        $this->num = config('site.list_num');
    }

    public function create($data)
    {
        return $this->manager->create($data);
    }

    /**
     * 获取所有显示记录（过滤管理员）
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get($num)
    {
        return $this->manager
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 获取可用的记录
     *
     * @param $page
     * @param $num
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAvailable(...$select)
    {
        return $this->manager
            ->select($select)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取显示的搜索结果（超级管理员级）
     *
     * @param $num
     * @param $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getSearch($num, $keyword)
    {
        return $this->manager
            ->where(function ($query) use ($keyword) {
                $query->where('managers.name', 'like', "%$keyword%")
                    ->orwhere('managers.email', 'like', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate($num);
    }

    /**
     * 根据店铺获取理发师
     *
     * @param $strore_id
     * @return mixed
     */
    public function getByStore($strore_id)
    {
        return $this->manager
            ->orderBy('id', 'desc')
            ->where('store_id', $strore_id)
            ->where('status', 1)
            ->paginate($this->num);
    }
    
    public function first($id)
    {
        return $this->manager->find($id);
    }

    public function superId()
    {
        return $this->manager
            ->where('name', config('site.admin_name'))
            ->first();
    }

    public function destroy($id)
    {
        return $this->manager
            ->where('id', $id)
            ->delete();
    }

    public function selectFirst($where, ...$select)
    {
        return $this->manager
            ->select($select)
            ->where($where)
            ->first();
    }

    public function update($id, $data)
    {
        return $this->manager
            ->where('id', $id)
            ->update($data);
    }

    public function count($where)
    {
        return $this->manager
            ->where($where)
            ->count();
    }
}