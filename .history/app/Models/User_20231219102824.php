<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'usr_id'; // Tetapkan primary key
    public $incrementing = false; // Set agar tidak dianggap auto-increment
    
    protected $fillable = [
        'usr_id',
        'usr_nama',
        'prodi_id',
        'usr_username',
        'usr_password',
        'usr_role',
        'usr_email',
        'usr_notelpon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'usr_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prodi()
    {
        return $this -> hasOne(Prodi::class);
    }

    public function buku()
    {
        return $this -> hasMany(Buku::class, 'usr_id', 'usr_id');
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
