<?php

namespace App\Models;

use CodeIgniter\Model;

class Purchases extends Model
{
    protected $table = "purchases";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = [
        'code', 'date', 'supplier_id', 'sub_total', 'disc_percent', 'disc_amount', 'grand_total', 'status', 'note',
        'user_create', 'user_update'
    ];
}
