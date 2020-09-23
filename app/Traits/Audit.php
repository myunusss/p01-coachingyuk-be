<?php

namespace App\Traits;

use App\Helpers\DateTime;
use App\Helpers\Generate;
use Illuminate\Support\Facades\Auth;

trait Audit
{
    public function prepareAuditInsert($object)
    {
        $object->{'created_at'} =  DateTime::getDateTime();
        $object->{'updated_at'} =  DateTime::getDateTime();
    }

    public function prepareAuditUpdate($object)
    {
        $object->{'updated_at'} =  DateTime::getDateTime();
    }

    public function prepareAuditRestore($object)
    {
        $object->{'deleted_at'} = null;
    }
}
