<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     protected $fillable = [
        'nama', 'username', 'email', 'password', 'level', 'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'token',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAllUsers($currentLevel)
    {
        $query = self::leftJoin('mt_role', 'admin.level', '=', 'mt_role.id')
            ->select('admin.*', 'mt_role.level as level_name');

        if ($currentLevel != 1) {
            $query->where('admin.level', '!=', 1);
        }

        return $query->get();
    }

    public static function getRoles()
    {
        $query = DB::table('mt_role');
        if (session('level') == 2) {
            $query->where('id', '!=', 1);
        }
        return $query->get();
    }

    public static function createUser(array $data, $photo = null)
    {
        return self::create([
            'nama'     => $data['nama'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'level'    => $data['level'],
            'foto'     => $photo,
        ]);
    }

    public function updateUser(array $data, $photo = null)
    {
        $this->nama = $data['nama'];
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->level = $data['level'];

        if (!empty($data['password'])) {
            $this->password = Hash::make($data['password']);
        }

        if ($photo !== null) {
            $this->foto = $photo;
        }

        $this->save();
    }
}
