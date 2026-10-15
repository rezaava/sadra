<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::orderBy('id')->get();

        return view('admin.products.form', [
            'product' => new Products(),
            'categories' => $categories,
            'pageTitle' => 'افزودن محصول',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'about' => ['nullable', 'string'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'نام محصول الزامی است.',
            'title.required' => 'عنوان محصول الزامی است.',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpg، jpeg، png یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'));
        }

        $product = Products::create([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'description' => $validated['description'] ?? null,
            'about' => $validated['about'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $features = $request->input('features', []);

        foreach ($features as $feature) {
            if (trim($feature) !== '') {
                $product->features()->create([
                    'text' => trim($feature),
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'محصول با موفقیت ایجاد شد.');
    }

    public function edit(Products $product)
    {
        $product->load('features');

        $categories = Categories::orderBy('id')->get();

        return view('admin.products.form', [
            'product' => $product,
            'categories' => $categories,
            'pageTitle' => 'ویرایش محصول',
        ]);
    }

    public function update(Request $request, Products $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'description' => ['nullable', 'string'],
            'about' => ['nullable', 'string'],
            'features' => ['nullable', 'array'],
            'features.*' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'نام محصول الزامی است.',
            'title.required' => 'عنوان محصول الزامی است.',
            'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpg، jpeg، png یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $data = [
            'name' => $validated['name'],
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'] ?? null,
            'about' => $validated['about'] ?? null,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($product->image) {
                $oldImage = ($product->image);

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $product->update($data);

        /*
        |--------------------------------------------------------------------------
        | Update Features
        |--------------------------------------------------------------------------
        */

        $product->features()->delete();

        $features = $request->input('features', []);

        foreach ($features as $feature) {
            if (trim($feature) !== '') {
                $product->features()->create([
                    'text' => trim($feature),
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'محصول با موفقیت ویرایش شد.');
    }

    public function destroy(Products $product)
    {
        if ($product->image) {
            $image = ($product->image);

            if (File::exists($image)) {
                File::delete($image);
            }
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }

    public function toggle(Products $product)
    {
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        return redirect()
            ->back()
            ->with('success', 'وضعیت محصول تغییر کرد.');
    }

    private function uploadImage($file)
    {
        $directory = ('product');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $fileName);

        return 'product/' . $fileName;
    }
}