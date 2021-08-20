<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseDetails extends Model
{
    protected $table = "purchase_details";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['header_id', 'item_name', 'qty', 'price', 'disc_percent_d', 'disc_amount_d', 'total_price'];
}
