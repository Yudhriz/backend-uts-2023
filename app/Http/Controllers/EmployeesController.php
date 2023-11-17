<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mengimport Model Employees
use App\Models\Employees;


class EmployeesController extends Controller
{
    // Membuat method index
    public function index()
    {
        // Menggunakan model eloquent untuk select data
        $employees = Employees::all();
        // Jika Data Kosong
        if ($employees->isEmpty()) {
            $data = [
                'message' => 'Data Kosong',
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika data ada
            $data = [
                'message' => 'Menampilkan Seluruh Employees',
                'data' => $employees
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        }
    }

    // Membuat method store
    public function store(Request $request)
    {
        // Menangkap data request validate buat validasi
        $input = $request->validate([
            'nama' => 'required',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email',
            'status' => 'required',
            'hired_on' => 'required'
        ]);

        // Menggunakan model eloquent untuk insert data
        $employees = Employees::create($input);

        $data = [
            'message' => 'Menampilkan Employees Berhasil DItambahkan',
            'data' => $employees
        ];

        // mengirim data json dan kode 201 (Resource Created)
        return response()->json($data, 201);
    }

    // Membuat method show
    public function show($id)
    {
        // Menggunakan model eloquent untuk find data
        $employees = Employees::find($id);
        // Jika data ada
        if ($employees) {
            $data = [
                'message' => 'Get detail employees',
                'data' => $employees,
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika data tidak ada
            $data = [
                'message' => 'Employees not found',
            ];
            // mengirim data json dan kode 404 (resource not found)
            return response()->json($data, 404);
        }
    }

    // Membuat method update
    public function update(Request $request, $id)
    {
        // Menggunakan model eloquent untuk find data
        $employees = Employees::find($id);

        // Jika data berhasil di update
        if ($employees) {
            $input = [
                'nama' => $request->nama ?? $employees->nama,
                'gender' => $request->gender ?? $employees->gender,
                'phone' => $request->phone ?? $employees->phone,
                'address' => $request->address ?? $employees->address,
                'email' => $request->email ?? $employees->email,
                'status' => $request->status ?? $employees->status,
                'hired_on' => $request->hired_on ?? $employees->hired_on
            ];

            // Menggunakan model eloquent untuk update data
            $employees->update($input);

            $data = [
                'message' => 'Employees is update successfully',
                'data' => $employees
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika data tidak ada
            $data = [
                'message' => 'Employees not found',
            ];
            // mengirim data json dan kode 404 (resource not found)
            return response()->json($data, 404);
        }
    }

    // Membuat method destroy
    public function destroy($id)
    {
        // Menggunakan model eloquent untuk find data
        $employees = Employees::find($id);
        // Jika data berhasil di hapus
        if ($employees) {
            // Menggunakan model eloquent untuk delete data
            $employees->delete();

            $data = [
                'message' => 'Delete employees successfully',
                'data' => $employees,
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika data tidak ada
            $data = [
                'message' => 'employees not found',
            ];
            // mengirim data json dan kode 404 (resource not found)
            return response()->json($data, 404);
        }
    }

    // Membuat method search
    public function search($name)
    {
        // Menggunakan model eloquent untuk where dan get data
        $employees = Employees::where('nama', 'like', '%' . $name . '%')->get();
        // Jika data ada
        if ($employees->count() > 0) {
            $data = [
                'message' => 'Get searched employees',
                'data' => $employees,
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika data tidak ada
            $data = [
                'message' => 'Employees not found',
            ];
            // mengirim data json dan kode 404 (resource not found)
            return response()->json($data, 404);
        }
    }

    // Membuat method active
    public function active(Request $request)
    {
        // Menggunakan model eloquent untuk where dan get data
        $employees = Employees::where('status', 'Active')->get();

        // Fungsi count untuk menghitung total
        $totalActiveEmployees = $employees->count();

        $data = [
            'message' => 'Menampilkan semua employees yang aktif',
            'total' => $totalActiveEmployees,
            'data' => $employees
        ];
        // mengirim data json dan kode 200 (the request succeeded)
        return response()->json($data, 200);
    }

    // Membuat method inactive
    public function inactive(Request $request)
    {
        // Menggunakan model eloquent untuk where dan get data
        $employees = Employees::where('status', 'Inactive')->get();

        // Fungsi count untuk menghitung total
        $totalInactiveEmployees = $employees->count();

        $data = [
            'message' => 'Menampilkan semua employees yang tidak aktif',
            'total' => $totalInactiveEmployees,
            'data' => $employees
        ];
        // mengirim data json dan kode 200 (the request succeeded)
        return response()->json($data, 200);
    }
    // Membuat method terminated
    public function terminated(Request $request)
    {
        // Menggunakan model eloquent untuk where dan get data
        $employees = Employees::where('status', 'Terminated')->get();

        // Fungsi count untuk menghitung total
        $totalTerminatedEmployees = $employees->count();

        $data = [
            'message' => 'Menampilkan semua employees yang dihentikan',
            'total' => $totalTerminatedEmployees,
            'data' => $employees
        ];
        // mengirim data json dan kode 200 (the request succeeded)
        return response()->json($data, 200);
    }
}
