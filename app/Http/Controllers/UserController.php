<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $currentLevel = session('level');
        $currentUserId = session('admin_id');

        $users = User::getAllUsers($currentLevel);

        return view('user.index', compact('users', 'currentLevel', 'currentUserId') + ['pageTitle' => 'User Admin']);
    }

    public function create()
    {
        $roles = User::getRoles();

        return view('user.create', [
            'roles' => $roles,
            'pageTitle' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:admin,username',
            'email'    => 'nullable|email|unique:admin,email',
            'password' => 'required|string|min:6',
            'level'    => 'required|exists:mt_role,id',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        try {
            $photoData = $request->hasFile('photo') ? file_get_contents($request->file('photo')->getRealPath()) : null;

            User::createUser($validated, $photoData);

            return redirect()->route('user.index')->with('success', "{$validated['nama']} berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan user: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = User::getRoles();

        return view('user.edit', [
            'user' => $user,
            'roles' => $roles,
            'pageTitle' => 'Update User',
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email'    => 'nullable|email',
            'level'    => 'required|integer',
            'password' => 'nullable|string|min:6',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail($id);
        $photo = $request->hasFile('foto') ? file_get_contents($request->file('foto')->getRealPath()) : null;

        $user->updateUser($validated, $photo);

        return redirect()->route('user.index')->with('success', "Data {$user->nama} berhasil diupdate.");
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => "Data {$user->nama} berhasil dihapus.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal hapus data.',
            ]);
        }
    }

    public function blokUser(Request $request)
    {
        $userId = $request->input('id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
        }

        $user->flag_active = $user->flag_active ? null : 1;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => $user->flag_active ? 'User dinonaktifkan' : 'User diaktifkan',
            'status' => $user->flag_active ? 'nonaktif' : 'aktif'
        ]);
    }
}