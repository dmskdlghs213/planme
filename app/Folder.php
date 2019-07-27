<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    public function tasks()
    {
        //第１引数＝関連するモデル名、第2引数=関連するテーブルがもつ外部キーカラム名、
        //第3引数=定義されてる側のテーブルがもつ外部キーに紐づけられたカラム名
        return $this->hasMany('App\Task');
    }
}
