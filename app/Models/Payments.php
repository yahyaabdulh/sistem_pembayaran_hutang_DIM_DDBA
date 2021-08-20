<?php

namespace App\Models;

use CodeIgniter\Model;

class Payments extends Model
{
    protected $table = "payments";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'code', 'date', 'supplier_id', 'bill_amount', 'paid_amount', 'status', 'note',
        'user_create', 'user_update'
    ];
}
