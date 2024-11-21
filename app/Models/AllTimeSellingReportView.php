<?php
// @AR, start

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTimeSellingReportView extends Model
{
    use HasFactory;
    
    public function __construct()
    {
        $this->setTable('all_time_selling_report_view'); // nama View-nya
    }
}
// @AR, end
