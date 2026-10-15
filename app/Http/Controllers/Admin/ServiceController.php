<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->withCount('items')
            ->latest()
            ->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('name')->get();

        return view('admin.services.form', [
            'service' => new Service(),
            'categories' => $categories,
            'pageTitle' => 'افزودن خدمت',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string'],
            'description' => ['required', 'string'],

            'projects_count' => ['required', 'integer', 'min:0'],
            'brands_count' => ['required', 'integer', 'min:0'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'industries_count' => ['required', 'integer', 'min:0'],

            'items' => ['nullable', 'array'],
            'items.*.number' => ['nullable', 'integer', 'min:0'],
            'items.*.icon' => ['nullable', 'string'],
            'items.*.title' => ['nullable', 'string', 'max:255'],
            'items.*.text' => ['nullable', 'string'],
            'items.*.tags' => ['nullable', 'array'],
            'items.*.tags.*' => ['nullable', 'string', 'max:255'],
        ], [
            'service_category_id.required' => 'دسته‌بندی خدمت الزامی است.',
            'service_category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'name.required' => 'نام خدمت الزامی است.',
            'icon.required' => 'آیکن خدمت الزامی است.',
            'description.required' => 'توضیحات خدمت الزامی است.',
        ]);

        DB::transaction(function () use ($validated) {

            $service = Service::create([
                'service_category_id' => $validated['service_category_id'],
                'name' => $validated['name'],
                'icon' => $validated['icon'],
                'description' => $validated['description'],
                'projects_count' => $validated['projects_count'],
                'brands_count' => $validated['brands_count'],
                'experience_years' => $validated['experience_years'],
                'industries_count' => $validated['industries_count'],
            ]);

            $this->syncItems(
                $service,
                $validated['items'] ?? []
            );
        });

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت ایجاد شد.');
    }

    public function edit(Service $service)
    {
        $service->load([
            'items.tags',
            'category',
        ]);

        $categories = ServiceCategory::orderBy('name')->get();

        return view('admin.services.form', [
            'service' => $service,
            'categories' => $categories,
            'pageTitle' => 'ویرایش خدمت',
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string'],
            'description' => ['required', 'string'],

            'projects_count' => ['required', 'integer', 'min:0'],
            'brands_count' => ['required', 'integer', 'min:0'],
            'experience_years' => ['required', 'integer', 'min:0'],
            'industries_count' => ['required', 'integer', 'min:0'],

            'items' => ['nullable', 'array'],
            'items.*.number' => ['nullable', 'integer', 'min:0'],
            'items.*.icon' => ['nullable', 'string'],
            'items.*.title' => ['nullable', 'string', 'max:255'],
            'items.*.text' => ['nullable', 'string'],
            'items.*.tags' => ['nullable', 'array'],
            'items.*.tags.*' => ['nullable', 'string', 'max:255'],
        ], [
            'service_category_id.required' => 'دسته‌بندی خدمت الزامی است.',
            'service_category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'name.required' => 'نام خدمت الزامی است.',
            'icon.required' => 'آیکن خدمت الزامی است.',
            'description.required' => 'توضیحات خدمت الزامی است.',
        ]);

        DB::transaction(function () use ($validated, $service) {

            $service->update([
                'service_category_id' => $validated['service_category_id'],
                'name' => $validated['name'],
                'icon' => $validated['icon'],
                'description' => $validated['description'],
                'projects_count' => $validated['projects_count'],
                'brands_count' => $validated['brands_count'],
                'experience_years' => $validated['experience_years'],
                'industries_count' => $validated['industries_count'],
            ]);

            $service->items()->each(function ($item) {
                $item->tags()->delete();
            });

            $service->items()->delete();

            $this->syncItems(
                $service,
                $validated['items'] ?? []
            );
        });

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت ویرایش شد.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت حذف شد.');
    }

    private function syncItems(Service $service, array $items)
    {
        foreach ($items as $itemData) {

            if (
                empty($itemData['title']) &&
                empty($itemData['text']) &&
                empty($itemData['icon'])
            ) {
                continue;
            }

            $item = $service->items()->create([
                'number' => $itemData['number'] ?? 0,
                'icon' => $itemData['icon'] ?? '',
                'title' => $itemData['title'] ?? '',
                'text' => $itemData['text'] ?? '',
            ]);

            $tags = $itemData['tags'] ?? [];

            foreach ($tags as $tag) {

                if (trim($tag) === '') {
                    continue;
                }

                $item->tags()->create([
                    'name' => trim($tag),
                ]);
            }
        }
    }
}