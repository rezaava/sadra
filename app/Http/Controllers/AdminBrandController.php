<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img' => ['required'],
        ], [
            'name.required' => 'نام برند الزامی است.',
            'name.max' => 'نام برند نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'img.required' => 'انتخاب تصویر برند الزامی است.',
            'img.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'img.mimes' => 'فرمت تصویر باید JPG، PNG یا WEBP باشد.',
            'img.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        $directory = ('uploads/brands');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $image = $request->file('img');
        $filename = Str::uuid() . '.' . $image->extension();

        $image->move($directory, $filename);

        $brand = new Brand();
        $brand->name = $validated['name'];
        $brand->img = 'uploads/brands/' . $filename;
        $brand->save();

        return response()->json([
            'success' => true,
            'message' => 'برند با موفقیت اضافه شد.',
            'brand' => [
                'id' => $brand->id,
                'name' => $brand->name,
                'img' => asset($brand->img),
                'created_at' => $brand->created_at->format('Y/m/d'),
                'update_url' => route('admin.brands.update', $brand->id),
                'delete_url' => route('admin.brands.destroy', $brand->id),
            ],
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img' => ['nullable'],
        ], [
            'name.required' => 'نام برند الزامی است.',
            'name.max' => 'نام برند نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'img.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'img.mimes' => 'فرمت تصویر باید JPG، PNG یا WEBP باشد.',
            'img.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        $brand->name = $validated['name'];

        if ($request->hasFile('img')) {
            $directory = ('uploads/brands');

            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            $image = $request->file('img');
            $filename = Str::uuid() . '.' . $image->extension();

            $image->move($directory, $filename);

            $oldImage = ($brand->img);

            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $brand->img = 'uploads/brands/' . $filename;
        }

        $brand->save();

        return response()->json([
            'success' => true,
            'message' => 'اطلاعات برند با موفقیت ویرایش شد.',
            'brand' => [
                'id' => $brand->id,
                'name' => $brand->name,
                'img' => asset($brand->img),
                'created_at' => $brand->created_at->format('Y/m/d'),
                'update_url' => route('admin.brands.update', $brand->id),
                'delete_url' => route('admin.brands.destroy', $brand->id),
            ],
        ]);
    }

    public function destroy(Brand $brand)
    {
        $image = ($brand->img);

        if (File::exists($image)) {
            File::delete($image);
        }

        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'برند با موفقیت حذف شد.',
            'id' => $brand->id,
        ]);
    }
}