<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Suppliers extends Model
{
    protected $table = "suppliers";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['code', 'name', 'address', 'tlp', 'tlp2', 'fax', 'email', 'note', 'is_active'];

}