<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'pdn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment
    public $timestamps = false;

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
        'pdn_tipe',
        'pdn_jenis',
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

    // Assuming the foreign key is 'usr_id' in the Pengaduan model
    public function user()
    {
        return $this->belongsTo(User::class, 'usr_id');
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
        return $this -> belongsTo(Jurnal::class);
    }
    public function buku(){
        return $this -> belongsTo(Buku::class);
    }
    public function pengabdian(){
        return $this -> belongsTo(PengabdianMasyarakat::class);
    }
}
