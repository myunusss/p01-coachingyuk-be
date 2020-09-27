<?php

namespace App\Services\CategoryService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Helpers\FileHelper;

class StoreCategory extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = $dto['name'];
        
        $backgroundFile = $dto['background'];

        $category->background = FileHelper::uploadFile($backgroundFile);

        $this->prepareAuditInsert($category);

        $category->save();

        $this->results['data'] = $category;

        //Isi pesan hasil proses
        $this->results['message'] = 'Category successfully created';
    }
}
