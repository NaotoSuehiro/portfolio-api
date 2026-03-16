<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class InquiryTask extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

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

    public function inquiryComments(): HasMany
    {
        return $this->hasMany(InquiryComment::class, 'inquiry_task_id', 'inquiry_task_id');
    }
}
