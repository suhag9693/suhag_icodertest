<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'department_id' => 'required|exists:departments,id',
            'phone' => 'required|string|max:15',
            'salary' => 'required|numeric',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required|exists:departments,id',
            'phone' => 'required|string|max:15',
            'salary' => 'required|numeric',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
    public function list(request $request)
    {
        if ($request->ajax()) {
            $data = Employee::query()
                ->join('departments', 'employees.department_id', '=', 'departments.id')
                ->select('employees.*', 'departments.name as department_name')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($employee) {

                    $viewButton = '<a href="' . route('employees.show', $employee->id) . '" class="btn btn-info btn-sm">View</a>';
                    $editButton = '<a href="' . route('employees.edit', $employee->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                    $deleteButton = '<form action="' . route('employees.destroy', $employee->id) . '" method="POST" style="display:inline;">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>';

                    return $viewButton . ' ' . $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function generatePdfReport()
    {
        $employees =  Employee::select('id','name','email','phone','department_id', DB::raw('MAX(salary) as highest_salary'))
        ->groupBy('department_id')
        ->with('department') 
        ->get();
        $pdf = FacadePdf::loadView('employees.pdf_report', compact('employees'));
        return $pdf->download('employees_report.pdf');
    }
}
