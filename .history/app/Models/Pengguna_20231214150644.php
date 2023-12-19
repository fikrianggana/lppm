<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $primaryKey = 'pgn_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->pkm_id) {
                $latestId = static::max('pkm_id');
                $nextId = $latestId ? (int)substr($latestId, 3) + 1 : 1;
                $model->pgn_id = 'PKM' . sprintf("%03s", $nextId);
            }
        });
    }

    protected $fillable = [
        'pgn_id',
        'pgn_nama',
        'prodi_id',
        'pgn_username',
        'pgn_password',
        'pgn_role',
        'pgn_email',
        'pgn_notelpon',
    ];

    public function prodi()
    {
        return $this -> hasOne(Prodi::class);
    }

    public function buku()
    {
        return $this -> hasMany(Buku::class, 'pgn_id', 'pgn_id');
    }

    public function hakCipta()
    {
        return $this -> hasOne(HakCipta::class);
    }

    public function pengajuansuratTugas()
    {
        return $this -> hasOne(PengajuanSuratTugas::class);
    }

    public function prosiding()
    {
        return $this -> hasOne(Prosiding::class);
    }

    public function pengabdianMasyarakat(){
        return $this-> belongsToMany(PengabdianMasyarakat::class);
    }

    public function hakPaten(){
        return $this->hasOne(HakPaten::class);
    }

    public function jurnal(){
        return $this->hasOne(Jurnal::class);
    }

    public function seminar(){
        return $this->hasOne(Seminar::class);
    }
}
