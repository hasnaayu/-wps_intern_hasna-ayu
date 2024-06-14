<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->keyword)) {
            $users = User::whereHas('role', function ($query) {
                $query->where('label', '!=', 'direktur');
            })
                ->where('name', 'ilike', '%' . $request->keyword . '%')
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $users = User::whereHas('role', function ($query) {
                $query->where('label', '!=', 'direktur');
            })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('pages.employees.index', ['users' => $users, 'title' => 'Daftar Karyawan', 'desc' => 'Daftar Karyawan']);
    }

    public function create()
    {
        $roles = Role::where('label', '!=', 'direktur')->get();
        return view('pages.employees.create', [
            'roles' => $roles,
            'title' => 'Tambah Data Karyawan',
            'desc' => 'Tambah Data Karyawan'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'role_id' => 'required',
                'email' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('/dashboard/employee')->with('error', 'Data karyawan gagal disimpan! Pastikan data yang dimasukkan benar.');
            } else {
                $existing_user = User::where('email', $request->email)
                    ->select('id')->first();
                if (!$existing_user) {
                    $random_number = random_int(1000, 9999);
                    $user_id = strval($random_number);
                    $user = User::create([
                        'user_id' => $user_id,
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => $request->email,
                        'role_id' => $request->role_id,
                        'is_active' => 1,
                        'password' => Hash::make($request->username . $user_id)
                    ]);
                    return redirect('/dashboard/employee')->with('success', 'Data Karyawan berhasil disimpan!');
                } else {
                    return redirect()->back()->with('error', 'Email sudah terdaftar! Masukkan alamat email lain yang belum terdaftar!');
                }
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Data Karyawan gagal disimpan!');
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::where('label', '!=', 'direktur')->get();
        return view('pages.employees.edit', [
            'user' => $user,
            'roles' => $roles,
            'title' => 'Edit Data Karyawan',
            'desc' => 'Edit Data Karyawan'
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'role_id' => 'required',
                'email' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('/dashboard/employee')->with('error', 'Data karyawan gagal disimpan! Pastikan data yang dimasukkan benar dan lengkap atau alamat email yang belum terdaftar sebelumnya.');
            } else {
                $existing_user = User::where('email', $request->email)
                    ->where('id', '!=', $id)
                    ->select('id')
                    ->first();
                if (!$existing_user) {
                    $user = DB::table('users')->where('id', $id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'email' => $request->email,
                        'role_id' => $request->role_id
                    ]);
                    return redirect('/dashboard/employee')->with('success', 'Data Karyawan berhasil diperbarui!');
                } else {
                    return redirect()->back()->with('error', 'Email sudah terdaftar! Masukkan alamat email lain yang belum terdaftar!');
                }
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Data Karyawan gagal diperbarui!');
        }
    }

    public function change_status($id)
    {
        try {
            $user = User::where('id', $id)
                ->select('is_active')
                ->first();
            if ($user->is_active == true) {
                $is_active = false;
            } else {
                $is_active = true;
            }
            $values = array('is_active' => $is_active);
            User::where('id', $id)->update($values);
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diubah!',
                'user' => $user
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => true,
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data karyawan!'
        ]);
    }
}
