<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InquiryTasks extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    //主キー
    protected $primaryKey = 'inquiry_task_id';
    protected $keyType = 'string';

    //数字の自動附番をOFF
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'inquiry_task_id',
        'user_id',
        'title',
        'content',
        'status',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function inquiryTalks(): HasMany
    {
        return $this->hasMany(InquiryTalks::class, 'inquiry_task_id', 'inquiry_task_id');
    }
}
