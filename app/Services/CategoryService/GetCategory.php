<?php

namespace App\Services\CategoryService;

use App\Models\Category;
use App\Services\ServiceInterface;
use App\Services\DefaultService;

class GetCategory extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $category = Category::with('topics')->orderBy($dto['sort_by'], $dto['sort_dir']);

        if ($dto['id'] != null) {
            $category->where('id', $dto['id']);
            $data = $category->first();
        } else {
            $this->results['pagination'] = $this->paginationDetail($dto['per_page'], $dto['page'], $category->count());
            $category = $this->paginateData($category, $dto['per_page'], $dto['page']);
            $data = $category->get();
        }

        $this->results['message'] = 'Category data successfully fetched';
        $this->results['data'] = $data;
    }
}
