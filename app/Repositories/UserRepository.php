<?php

namespace App\Repositories;

use App\Models\User;
use App\RepositoryInterfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private User $_user;

    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    public function list()
    {
        return $this->_user->get();
    }

    public function add($data)
    {
        $this->_user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function show($id)
    {
        return $this->_user->where('id', $id)->first();
    }

    public function update($id, $data)
    {
        $this->_user->where('id', $id)->update([
            'name' => $data['name'],
            'phone' => $data['phone']
        ]);
    }

    public function delete($id)
    {
        $this->_user->where('id', $id)->delete();
    }
}
