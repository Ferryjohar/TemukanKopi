<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'ms_admin'; // Beritahu Laravel nama tabelnya
    protected $primaryKey = 'id_user'; // Beritahu Primary Key-nya
    // Kolom yang boleh diisi
    protected $fillable = ['nama', 'username', 'password', 'role', 'status', 'foto']; 
}