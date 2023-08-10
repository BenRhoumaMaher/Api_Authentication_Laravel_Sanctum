<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Void_;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'is_done'
    ];
    protected $casts = [
        'is_done' => 'boolean'
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    protected static function booted(): void
    {
        static::addGlobalScope('creator', function (Builder $builder) {
            $builder->where('creator_id', Auth::id());
        });
    }
}