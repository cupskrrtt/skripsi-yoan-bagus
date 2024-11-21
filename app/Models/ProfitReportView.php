<?php
// @AR, start

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitReportView extends Model
{
    use HasFactory;
    
    public function __construct()
    {
        $this->setTable('profit_report_view'); // nama View-nya
    }
}
// @AR, end
