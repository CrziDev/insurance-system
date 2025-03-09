<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NonLifeInsurance;
use App\Models\LifeInsurance;

class Policy extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function nonLifeInsurance(){
        return $this->hasMany(NonLifeInsurance::class,'type_id');
    }
    public function LifeInsurance(){
        return $this->hasMany(LifeInsurance::class,'type_id');
    }

    public function getyearlyCostAttribute(){
        return ($this->premium + $this->docstamp + $this->govtax + $this->others);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'date',
        ];
    }
}
