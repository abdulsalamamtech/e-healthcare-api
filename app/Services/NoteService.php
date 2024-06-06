<?php

namespace App\Services;

class NoteService{

    public function getMetadata($data){
        return [
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'previous_page_url' => $data->previousPageUrl(),
            'next_page_url' => $data->nextPageUrl(),
        ];
    }
}
