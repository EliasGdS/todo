<?php

namespace App\Models;

use App\Observers\Tenant\TenantObserver;
use App\Scopes\Tenant\TenantScope;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['task', 'completed', 'user_id'];

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope);

        static::observe(new TenantObserver);
    }

    public function rules()
    {
        return [
            'task' => 'required|max:30',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
