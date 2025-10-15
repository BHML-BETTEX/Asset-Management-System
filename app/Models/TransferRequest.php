<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferRequest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'asset_tag',
        'asset_type', 
        'model',
        'from_company',
        'to_company',
        'description',
        'note',
        'transfer_date',
        'status',
        'item_status',
        'requested_by',
        'approved_by',
        'approved_at',
        'approval_notes',
        'store_id'
    ];

    protected $casts = [
        'transfer_date' => 'date',
        'approved_at' => 'datetime'
    ];

    // Relationship to Store
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    // Relationship to companies
    public function fromCompany()
    {
        return $this->belongsTo(Company::class, 'from_company', 'company');
    }

    public function toCompany()
    {
        return $this->belongsTo(Company::class, 'to_company', 'company');
    }

    // Scopes for filtering
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeForCompany($query, $company)
    {
        return $query->where('to_company', $company);
    }

    public function scopeBorrowedItems($query)
    {
        return $query->where('item_status', 'borrowed')
                    ->where('status', 'approved');
    }
}
