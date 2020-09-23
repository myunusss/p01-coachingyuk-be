<?php

namespace App\Traits;

trait Pagination
{

    public function paginateData($object, $per_page, $page, $is_model = true)
    {
        if ($page < 1) {
            $page = 1;
        }
        if ($is_model) {
            return $object->skip($per_page * ($page - 1))->take($per_page);
        } else {
            $res = [];
            foreach ($object->skip($per_page * ($page - 1))->take($per_page) as $key => $value) {
                $res[] = $value;
            }

            return $data = collect($res);
        }
    }

    public function paginationDetail($per_page, $page, $count)
    {
        $lastPage = (int) number_format($count / $per_page, 0);
        return [
            'data_per_page' => (int) $per_page,
            'next_page' => (int) $page + 1,
            'prev_page' => (int) $page - 1,
            'first_page' => 1,
            'last_page' => $lastPage,
            'next_page_url' => url()->current() . "?per_page=" . $per_page . "&page_number=" . ($page + 1),
            'previous_page_url' => url()->current() . "?per_page=" . $per_page . "&page_number=" . ($page - 1),
            'first_page_url' => url()->current() . "?per_page=" . $per_page . "&page_number=1",
            'last_page_url' => url()->current() . "?per_page=" . $per_page . "&page_number=" . $lastPage,
            'total_page' => (int) ceil($count / $per_page),
            'total_data' => (int) $count
        ];
    }
}
