<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->orderBy('bulan', 'desc')->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:10',
            'gaji_pokok'  => 'required|numeric|min:0',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(['karyawan_id', 'bulan', 'gaji_pokok', 'tunjangan', 'potongan']);
        $data['total_gaji'] = $data['gaji_pokok'] + ($data['tunjangan'] ?? 0) - ($data['potongan'] ?? 0);

        Salary::create($data);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);  
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:10',
            'gaji_pokok'  => 'required|numeric|min:0',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        $salary = Salary::findOrFail($id);
        $data = $request->only(['karyawan_id', 'bulan', 'gaji_pokok', 'tunjangan', 'potongan']);
        $data['total_gaji'] = $data['gaji_pokok'] + ($data['tunjangan'] ?? 0) - ($data['potongan'] ?? 0);

        $salary->update($data);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Salary::destroy($id);
        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
