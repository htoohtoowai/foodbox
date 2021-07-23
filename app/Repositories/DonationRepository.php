<?php

namespace App\Repositories;

use App\Models\Donation;

class DonationRepository extends BaseRepository
{
    public function __construct(Donation $model)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');

    }

    public function getDonationByDonorID($donorId)
    {
        return $this->model->where('donor_id', $donorId)->first();
    }

    public function getDonationByDoneeID($doneeId)
    {
        return $this->model->where('donee_id', $doneeId)->first();
    }
}
