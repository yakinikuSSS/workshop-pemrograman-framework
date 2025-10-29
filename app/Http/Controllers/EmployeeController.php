<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with(['department', 'position'])
            ->orderBy('status', 'asc')
            ->orderBy('departemen_id', 'asc')
            ->orderBy('nama_lengkap', 'asc')
            ->paginate(5);

        return view('employees.index', compact('employees'));
    }


    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees,email',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|in:aktif,nonaktif',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id'    => 'required|exists:positions,id',
            'tanggal_absen' => 'nullable|date',
            'waktu_masuk'   => 'nullable',
            'waktu_keluar'  => 'nullable',
            'status_absensi'=> 'nullable|in:hadir,izin,sakit,alpha',
        ]);

        $employee = Employee::create($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'departemen_id',
            'jabatan_id',
        ]));

        if ($request->filled('tanggal_absen')) {
            Attendance::create([
                'karyawan_id'   => $employee->id,
                'tanggal'       => $request->tanggal_absen,
                'waktu_masuk'   => $request->waktu_masuk,
                'waktu_keluar'  => $request->waktu_keluar,
                'status_absensi'=> $request->status_absensi ?? 'hadir',
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }


    public function show(Employee $employee)
    {
        $employee->load(['department', 'position', 'attendances']);
        return view('employees.show', compact('employee'));
    }


    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees,email,' . $id,
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|in:aktif,nonaktif',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id'    => 'required|exists:positions,id',
            'tanggal_absen' => 'nullable|date',
            'waktu_masuk'   => 'nullable',
            'waktu_keluar'  => 'nullable',
            'status_absensi'=> 'nullable|in:hadir,izin,sakit,alpha',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'departemen_id',
            'jabatan_id',
        ]));

        if ($request->filled('tanggal_absen')) {
            Attendance::updateOrCreate(
                [
                    'karyawan_id' => $employee->id,
                    'tanggal'     => $request->tanggal_absen,
                ],
                [
                    'waktu_masuk'   => $request->waktu_masuk,
                    'waktu_keluar'  => $request->waktu_keluar,
                    'status_absensi'=> $request->status_absensi ?? 'hadir',
                ]
            );
        }

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }


    public function editAttendance($id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        $employee = $attendance->employee;

        return view('attendance.edit-attendance', compact('employee', 'attendance'));
    }

    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'tanggal'        => 'required|date',
            'waktu_masuk'    => 'nullable',
            'waktu_keluar'   => 'nullable',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update([
            'tanggal'        => $request->tanggal,
            'waktu_masuk'    => $request->waktu_masuk,
            'waktu_keluar'   => $request->waktu_keluar,
            'status_absensi' => $request->status_absensi,
        ]);

        return redirect()->route('employees.show', $attendance->karyawan_id) ->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function deleteAttendance($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employeeId = $attendance->karyawan_id;
        $attendance->delete();

        return redirect()->route('employees.show', $employeeId) ->with('success', 'Data absensi berhasil dihapus.');
    }
}