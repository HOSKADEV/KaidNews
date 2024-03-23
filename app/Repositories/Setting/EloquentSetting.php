<?php

namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\Setting\SettingRepository;


class EloquentSetting implements SettingRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Setting::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Setting::find($id);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $setting = Setting::create($data);

        return $setting;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $setting = $this->find($id);

        $setting->update($data);

        return $setting;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $setting = $this->find($id);

        return $setting->delete();
    }
}
