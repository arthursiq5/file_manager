<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'description',
        'file_name',
        'path',
        'user_id',
    ] ;

    public function getPath(): string
    {
        return $this->path . '/'. $this->file_name;
    }

    public function getType(): string
    {
        $file_name = explode(".", $this->file_name);
        return end($file_name);
    }
}
