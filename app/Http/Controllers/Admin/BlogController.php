<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.form', [
            'blog' => new Blog(),
            'pageTitle' => 'افزودن بلاگ',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_text' => ['required', 'string', 'max:1000'],
            'text' => ['required', 'string'],
            'icon' => ['required', 'string'],
            'reading_time' => ['required', 'string', 'max:100'],
            'main_tag' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'عنوان بلاگ الزامی است.',
            'short_text.required' => 'توضیح کوتاه الزامی است.',
            'text.required' => 'متن بلاگ الزامی است.',
            'icon.required' => 'آیکن بلاگ الزامی است.',
            'reading_time.required' => 'زمان مطالعه الزامی است.',
            'main_tag.required' => 'تگ اصلی الزامی است.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpg، jpeg، png یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadImage($request->file('image'));
        }

        Blog::create([
            'title' => $validated['title'],
            'short_text' => $validated['short_text'],
            'text' => $validated['text'],
            'icon' => $validated['icon'],
            'reading_time' => $validated['reading_time'],
            'main_tag' => $validated['main_tag'],
            'image' => $imagePath,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'بلاگ با موفقیت ایجاد شد.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', [
            'blog' => $blog,
            'pageTitle' => 'ویرایش بلاگ',
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_text' => ['required', 'string', 'max:1000'],
            'text' => ['required', 'string'],
            'icon' => ['required', 'string'],
            'reading_time' => ['required', 'string', 'max:100'],
            'main_tag' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'عنوان بلاگ الزامی است.',
            'short_text.required' => 'توضیح کوتاه الزامی است.',
            'text.required' => 'متن بلاگ الزامی است.',
            'icon.required' => 'آیکن بلاگ الزامی است.',
            'reading_time.required' => 'زمان مطالعه الزامی است.',
            'main_tag.required' => 'تگ اصلی الزامی است.',
            'image.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpg، jpeg، png یا webp باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $data = [
            'title' => $validated['title'],
            'short_text' => $validated['short_text'],
            'text' => $validated['text'],
            'icon' => $validated['icon'],
            'reading_time' => $validated['reading_time'],
            'main_tag' => $validated['main_tag'],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($blog->image && File::exists($blog->image)) {
                File::delete($blog->image);
            }

            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $blog->update($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'بلاگ با موفقیت ویرایش شد.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && File::exists($blog->image)) {
            File::delete($blog->image);
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'بلاگ با موفقیت حذف شد.');
    }

    public function toggle(Blog $blog)
    {
        $blog->update([
            'is_active' => !$blog->is_active,
        ]);

        return redirect()
            ->back()
            ->with('success', 'وضعیت بلاگ تغییر کرد.');
    }

    private function uploadImage($file)
    {
        $directory = 'blogs';

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($directory, $fileName);

        return 'blogs/' . $fileName;
    }
}
