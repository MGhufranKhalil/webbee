<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
