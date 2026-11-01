<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'service' => new Service,
            'categories' => $categories,
            'pageTitle' => 'افزودن خدمت',
        ]);
    }

    private function uploadImage($file)
    {
        $directory = ('uploads/services');

        if (! file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();

        $file->move($directory, $filename);

        return 'uploads/services/'.$filename;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string'],
            'image' => ['nullable'],
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
        ]);

        DB::transaction(function () use ($validated, $request) {

            $service = Service::create([
                'service_category_id' => $validated['service_category_id'],
                'name' => $validated['name'],
                'icon' => $validated['icon'],
                'image' => $request->hasFile('image')
                    ? $this->uploadImage($request->file('image'))
                    : null,
                'description' => $validated['description'],
                'projects_count' => $validated['projects_count'],
                'brands_count' => $validated['brands_count'],
                'experience_years' => $validated['experience_years'],
                'industries_count' => $validated['industries_count'],
            ]);

            $this->syncItems($service, $validated['items'] ?? []);
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
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
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
        ]);

        DB::transaction(function () use ($validated, $service, $request) {

            $data = [
                'service_category_id' => $validated['service_category_id'],
                'name' => $validated['name'],
                'icon' => $validated['icon'],
                'description' => $validated['description'],
                'projects_count' => $validated['projects_count'],
                'brands_count' => $validated['brands_count'],
                'experience_years' => $validated['experience_years'],
                'industries_count' => $validated['industries_count'],
            ];

            if ($request->hasFile('image')) {

                if ($service->image && file_exists(($service->image))) {
                    unlink(($service->image));
                }

                $data['image'] = $this->uploadImage($request->file('image'));
            }

            $service->update($data);

            $service->items()->each(function ($item) {
                $item->tags()->delete();
            });

            $service->items()->delete();

            $this->syncItems($service, $validated['items'] ?? []);
        });

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'خدمت با موفقیت ویرایش شد.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && file_exists(($service->image))) {
            unlink(($service->image));
        }

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