<?php

namespace App\Models\Core;

use Hash;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_name',
        'first_name',
        'last_name',
        'gender',
        'country_code',
        'phone',
        'avatar',
        'status',
        'is_seen',
        'phone_verified',
        'created_at',
        'updated_at',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saveAdmin(array $data)
    {
        return User::create([
            'role_id' => 1,
            'user_name' => $data['user_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public static function getCustomers()
    {
        $user = User::sortable(['id' => 'ASC'])
            ->LeftJoin('user_to_address', 'user_to_address.user_id', '=', 'users.id')
            ->LeftJoin('address_book', 'address_book.address_book_id', '=', 'user_to_address.address_book_id')
            ->LeftJoin('countries', 'countries.countries_id', '=', 'address_book.entry_country_id')
            ->where('role_id', 2)
            ->select(
                'users.*',
                'address_book.entry_gender as entry_gender',
                'address_book.entry_firstname as entry_firstname',
                'address_book.entry_lastname as entry_lastname',
                'address_book.entry_street_address as entry_street_address',
                'address_book.entry_flat_address as entry_flat_address',
                'address_book.entry_city as entry_city',
                'address_book.address_type as address_type',
                'address_book.contact_number as contact_number',
                'countries.*'
            )
            ->groupby('users.id')
            ->paginate(10);
        return $user;
    }
}
