<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InquiryComment extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    //主キー
    protected $primaryKey = 'inquiry_comment_id';
    protected $keyType = 'string';

    //数字の自動附番をOFF
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'inquiry_comment_id',
        'inquiry_task_id',
        'user_id',
        'comment',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function inquiryTasks(): BelongsTo
    {
        return $this->belongsTo(InquiryTask::class, 'inquiry_task_id', 'inquiry_task_id');
    }
}
