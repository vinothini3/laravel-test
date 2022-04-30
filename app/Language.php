<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Language extends Model
{
    protected $lang = [
        1 => 'English',
        2 => 'French',
        3 => 'Spanish',
        4 => 'Chinese'
    ];

    protected $fillable = ['id_user', 'language'];

    public function getLanguageAttribute($value) {
        return Arr::get($this->lang, $value);
    }
}
