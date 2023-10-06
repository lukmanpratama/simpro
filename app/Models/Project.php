<?php

namespace App\Models;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    protected $fillable = ['project_name','deskripsi', 'status'];

    public function users()
    {
    	return $this->belongsToMany(User::class, 'teams')->withTimestamps();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'filetable');
    }
}
