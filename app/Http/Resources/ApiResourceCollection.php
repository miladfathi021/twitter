<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResourceCollection extends ResourceCollection
{
    public function pagination()
    {
        return [
            'current' => $this->currentPage(),
            'last' => $this->lastPage(),
            'base' => $this->url(1),
            'next' => $this->nextPageUrl(),
            'prev' => $this->previousPageUrl()
        ];
    }
}
