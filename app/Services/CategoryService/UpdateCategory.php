<?php

namespace App\Services\CategoryService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Category;

class UpdateCategory extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $category = Category::find($dto['id']);
        $category->name = $dto['name'] ?? $category->name;
        
        if ($dto['background'] != null) {
            $backgroundFile = $dto['background'];
            $category->background = FileHelper::uploadFile($backgroundFile);
        }

        $this->prepareAuditUpdate($category);

        $category->save();

        $this->results['data'] = $category;

        //Isi pesan hasil proses
        $this->results['message'] = 'Category successfully updated';
    }
}
