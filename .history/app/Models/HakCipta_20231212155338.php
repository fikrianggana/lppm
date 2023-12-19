<?php

number" class="form-contrP
            }
        });
    }

    protected $fillable = [
        'hcp_id',
        'hcp_namalengkap',
        'hcp_judul',
        'hcp_noapk',
        'hcp_sertifikat',
        'hcp_keterangan',
        'pgn_id',
    ];

    public function pengguna()
    {
        return $this -> hasMany(Pengguna::class);
    }
}
