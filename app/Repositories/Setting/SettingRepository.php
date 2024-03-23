<?php

namespace App\Repositories\Setting;

interface SettingRepository
{
    /**
     * Get all available Settings.
     * @return mixed
     */
    public function all();
    
    /**
     * {@inheritdoc}
     */
    public function create(array $data);

    
    /**
     * {@inheritdoc}
     */
    public function update($id, array $data);

    /**
     * {@inheritdoc}
     */
    public function delete($id);
}
