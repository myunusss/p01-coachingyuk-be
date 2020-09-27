<?php

namespace App\Services\CategoryService;

use App\Services\ServiceInterface;
use App\Services\DefaultService;

use App\Models\Category;

class DestroyCategory extends DefaultService implements ServiceInterface
{
    public function process($dto)
    {
        $category = Category::find($dto['id']);
        $category->delete();

        //Ganti true apabila terjadi kesalahan dalam proses
        $this->results['error'] = null;

        //Isi data hasil dalam proses
        $this->results['data'] = ['deleted' => true];

        //Isi pesan hasil proses
        $this->results['message'] = 'Category successfully deleted';

        //Optional
        $this->results['pagination'] = null;
    }
}
