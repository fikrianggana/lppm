<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pdn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pdn_id) {
                $latestId = static::max('pdn_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pdn_id = 'PDN' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pdn_id',
        'usr_id',
        'hpt_id',
        'pro_id',
        'smn_id',
        'hcp_id',
        'jrn_id',
        'bku_id',
        'pkm_id',
        'status',
        'keterangan',
    ];

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
    public function hakpaten(){
        return $this -> belongsTo(HakPaten::class);
    }
    public function prosiding(){
        return $this -> belongsTo(Prosiding::class);
    }
    public function seminar(){
        return $this -> belongsTo(Seminar::class);
    }
    public function hakcipta(){
        return $this -> belongsTo(HakCipta::class);
    }
    public function jurnal(){
        return $this -> belongsTo()
    }
}
