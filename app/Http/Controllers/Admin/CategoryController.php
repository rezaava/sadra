<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::with('parent')->latest()->get();

        $parentCategories = Categories::orderBy('name')->get();

        return view('admin.categories.index', compact('categories', 'parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.max' => 'نام دسته‌بندی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'parent_id.exists' => 'دسته‌بندی والد انتخاب‌شده معتبر نیست.',
            'description.string' => 'توضیحات باید متن معتبر باشد.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید JPG، PNG یا WEBP باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Categories::findOrFail($validated['parent_id']);

            if ($parent->parent_id !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'فقط امکان انتخاب دسته‌بندی‌های اصلی به‌عنوان والد وجود دارد.',
                ], 422);
            }
        }

        $category = new Categories();
        $category->name = $validated['name'];
        $category->parent_id = $validated['parent_id'] ?? null;
        $category->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            $category->image = $this->uploadImage($request->file('image'));
        }

        $category->save();
        $category->load('parent');

        return response()->json([
            'success' => true,
            'message' => 'دسته‌بندی با موفقیت اضافه شد.',
            'category' => $this->formatCategory($category),
        ]);
    }

    public function update(Request $request, Categories $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
                Rule::notIn([$category->id]),
            ],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.max' => 'نام دسته‌بندی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'parent_id.exists' => 'دسته‌بندی والد انتخاب‌شده معتبر نیست.',
            'parent_id.not_in' => 'یک دسته‌بندی نمی‌تواند والد خودش باشد.',
            'description.string' => 'توضیحات باید متن معتبر باشد.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید JPG، PNG یا WEBP باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Categories::findOrFail($validated['parent_id']);

            if ($parent->parent_id !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'فقط امکان انتخاب دسته‌بندی‌های اصلی به‌عنوان والد وجود دارد.',
                ], 422);
            }
        }

        $category->name = $validated['name'];
        $category->parent_id = $validated['parent_id'] ?? null;
        $category->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            $oldImage = $category->image;
            $category->image = $this->uploadImage($request->file('image'));

            if ($oldImage && File::exists(public_path($oldImage))) {
                File::delete(public_path($oldImage));
            }
        }

        $category->save();
        $category->load('parent');

        return response()->json([
            'success' => true,
            'message' => 'دسته‌بندی با موفقیت ویرایش شد.',
            'category' => $this->formatCategory($category),
        ]);
    }

    public function destroy(Categories $category)
    {
        $image = $category->image;

        $category->delete();

        if ($image && File::exists(public_path($image))) {
            File::delete(public_path($image));
        }

        return response()->json([
            'success' => true,
            'message' => 'دسته‌بندی با موفقیت حذف شد.',
            'id' => $category->id,
        ]);
    }

    private function uploadImage($image)
    {
        $directory = public_path('uploads/categories');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = Str::uuid() . '.' . $image->extension();

        $image->move($directory, $filename);

        return 'uploads/categories/' . $filename;
    }

    private function formatCategory(Categories $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'parent_id' => $category->parent_id,
            'parent_name' => $category->parent?->name,
            'description' => $category->description,
            'image' => $category->image ? asset($category->image) : null,
            'created_at' => $category->created_at?->format('Y/m/d'),
            'update_url' => route('admin.categories.update', $category->id),
            'delete_url' => route('admin.categories.destroy', $category->id),
        ];
    }
}