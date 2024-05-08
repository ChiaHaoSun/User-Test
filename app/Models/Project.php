<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = [];

    /**
     * 建立者
     *
     * @return HasOne
     */
    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    /**
     * 修改者
     *
     * @return HasOne
     */
    public function updater(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    /**
     * 刪除者
     *
     * @return HasOne
     */
    public function deleter(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }
}
