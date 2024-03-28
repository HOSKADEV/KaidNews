<?php

namespace App\Repositories\Certificate;

interface CertificateRepository
{
    /**
     * Get all available Certificates.
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
