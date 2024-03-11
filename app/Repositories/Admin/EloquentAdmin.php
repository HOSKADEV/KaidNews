<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Repositories\Admin\AdminRepository;
use App\Http\Filters\Admin\AdminKeywordSearch;

class EloquentAdmin implements AdminRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Admin::all();
    }

    /**
     * {@inheritdoc}
     */
    public function count(){
        return Admin::count(); 
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Admin::find($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $admin = Admin::create($data);

        return $admin;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $admin = $this->find($id);

        $admin->update($data);

        return $admin;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $admin = $this->find($id);

        return $admin->delete();
    }

    /**
     * @param $perPage
     * @param null $status
     * @param null $searchFrom
     * @param $searchTo
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate($perPage, $search = null, $status = null)
    {
        $query = Admin::query();
        
        // if ($status) {
        //     $query->where('status', $status);
        // }

        if ($search) {
            (new AdminKeywordSearch)($query, $search);
        }

        $result = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        if ($search) {
            $result->appends(['search' => $search]);
        }
        return $result;
    }
}
