<?php

namespace OrionMedical\Models;

use Illuminate\Database\Eloquent\Model;

class AttachDocuments extends Model
{
    public $timestamps = false;
	 protected $table = 'documents';
   	 protected $fillable = [
        'owner_id',
        'filename',
        'image'
    ];

    public function fileowner() {
    return $this->belongsToMany('\OrionMedical\Models\Customer');
}
}
