<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentDetails extends Model
{
    protected $table = "payment_details";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['header_id', 'purchase_id', 'bill', 'bill_payment', 'bill_remain', 'note'];
}
