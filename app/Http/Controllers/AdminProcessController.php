<?php

namespace App\Http\Controllers;

use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProcessController extends Controller
{
    public function index()
    {
        $processes = Process::orderBy('order')->orderBy('id')->get();

        return view('admin.processes', compact('processes'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'processes' => ['required', 'array'],
            'processes.*.class' => ['required', 'string'],
            'processes.*.title' => ['required', 'string', 'max:255'],
            'processes.*.text' => ['required', 'string'],
            'processes.*.order' => ['required', 'integer', 'min:0'],
        ], [
            'processes.*.class.required' => 'فیلد کلاس الزامی است.',
            'processes.*.title.required' => 'عنوان الزامی است.',
            'processes.*.text.required' => 'متن الزامی است.',
            'processes.*.order.required' => 'ترتیب نمایش الزامی است.',
            'processes.*.order.integer' => 'ترتیب نمایش باید عدد باشد.',
            'processes.*.order.min' => 'ترتیب نمایش نمی‌تواند منفی باشد.',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['processes'] as $id => $data) {
                Process::findOrFail($id)->update($data);
            }
        });

        return redirect()->route('admin.processes.index')
            ->with('success', 'تمام تغییرات با موفقیت ذخیره شدند.');
    }
}