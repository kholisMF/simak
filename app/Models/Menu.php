<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'tbl_menu';

    protected $fillable = [
        'parent_id', 'title', 'route', 'icon', 'urutan', 'is_active'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('urutan');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public static function getActiveMenus()
    {
        return self::whereNull('parent_id')->where('is_active', 1)->orderBy('urutan')->with('children')->get();
    }
}

