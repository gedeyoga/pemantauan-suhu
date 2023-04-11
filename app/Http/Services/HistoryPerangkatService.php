<?php

namespace App\Http\Services;

use App\Events\HistoryPerangkatWasCreated;
use App\Models\HistoryPerangkat;

class HistoryPerangkatService
{
    public function create(array $data)
    {
        $history = HistoryPerangkat::create($data);

        event(new HistoryPerangkatWasCreated($history));

        return $history;
    }
}
