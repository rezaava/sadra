<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount('services')
            ->latest()
            ->get();

        return view('admin.services.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.services.categories.form', [
            'category' => new ServiceCategory(),
            'pageTitle' => 'افزودن دسته‌بندی خدمات',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'icon.required' => 'آیکن دسته‌بندی الزامی است.',
        ]);

        ServiceCategory::create($validated);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'دسته‌بندی خدمات با موفقیت ایجاد شد.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.services.categories.form', [
            'category' => $serviceCategory,
            'pageTitle' => 'ویرایش دسته‌بندی خدمات',
        ]);
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'icon.required' => 'آیکن دسته‌بندی الزامی است.',
        ]);

        $serviceCategory->update($validated);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'دسته‌بندی خدمات با موفقیت ویرایش شد.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'دسته‌بندی خدمات با موفقیت حذف شد.');
    }
}