<?php

namespace App\Repositories\Certificate;

use App\Models\Certificate;
use App\Repositories\Certificate\CertificateRepository;


class EloquentCertificate implements CertificateRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Certificate::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Certificate::find($id);
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $setting = Certificate::create($data);

        return $setting;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $certificate = $this->find($id);

        $certificate->update($data);

        return $certificate;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $certificate = $this->find($id);

        return $certificate->delete();
    }
}
