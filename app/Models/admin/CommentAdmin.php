<?php

namespace App\Models\Admin;

use App\Models\Comment;

class CommentAdmin extends Comment
{
    protected $table = 'comments'; // dùng chung bảng

    public function scopeAllStatus($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    // Badge hiển thị status
    public function statusBadge()
    {
        return match($this->status) {
            0 => '<span class="badge bg-warning">Pending</span>',
            1 => '<span class="badge bg-success">Approved</span>',
            2 => '<span class="badge bg-secondary">Hidden</span>',
        };
    }
}