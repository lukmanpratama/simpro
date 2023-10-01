<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    public function users()
    {
    	return $this->belongsToMany(User::class, 'teams');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'filetable');
    }
}
