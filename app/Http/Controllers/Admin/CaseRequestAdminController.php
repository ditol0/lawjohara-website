<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseRequest;
use Illuminate\Http\Request;

class CaseRequestAdminController extends Controller
{
    public function index()
    {
        $cases = CaseRequest::latest()->paginate(20);

        $stats = [
            'total'       => CaseRequest::count(),
            'pending'     => CaseRequest::where('status', 'new')->count(),
            'completed'   => CaseRequest::where('status', 'closed')->count(),
            'in_progress' => CaseRequest::where('status', 'in_progress')->count(),
        ];

        return view('admin.cases.index', compact('cases', 'stats'));
    }

    public function show(CaseRequest $case)
    {
        return view('admin.cases.show', compact('case'));
    }

    public function updateStatus(Request $request, CaseRequest $case)
    {
        $data = $request->validate([
            'status' => 'required|in:new,in_progress,closed',
        ]);

        $case->update([
            'status' => $data['status'],
        ]);

        return back()->with('success', 'تم تحديث حالة الطلب.');
    }

    /**
     * ✅ حذف قضية
     */
    public function destroy(CaseRequest $case)
    {
        $case->delete();

        return redirect()
            ->route('admin.cases')
            ->with('success', 'تم حذف القضية بنجاح');
    }
}