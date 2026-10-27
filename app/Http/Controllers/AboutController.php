<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutStat;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        $stats = AboutStat::orderBy('order')->get();

        return view('pages.about', compact('about', 'stats'));
    }

    public function Adindex()
    {
        $about = About::first();

        return view('admin.aboutEdit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slogan' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'img' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'title.required' => 'عنوان الزامی است.',
            'slogan.required' => 'شعار الزامی است.',
            'text.required' => 'متن درباره ما الزامی است.',
            'img.image' => 'فایل انتخاب‌شده باید تصویر باشد.',
            'img.mimes' => 'فرمت تصویر باید JPG، PNG یا WEBP باشد.',
            'img.max' => 'حجم تصویر نباید بیشتر از ۵ مگابایت باشد.',
        ]);

        $about = About::first() ?? new About;

        $about->title = $validated['title'];
        $about->slogan = $validated['slogan'];
        $about->text = $validated['text'];

        if ($request->hasFile('img')) {
            $directory = 'uploads/about';

            if (! \Illuminate\Support\Facades\File::isDirectory($directory)) {
                \Illuminate\Support\Facades\File::makeDirectory($directory, 0755, true);
            }

            $image = $request->file('img');
            $filename = \Illuminate\Support\Str::uuid().'.'.$image->extension();

            $image->move($directory, $filename);

            $oldImage = $about->img;

            if ($oldImage && \Illuminate\Support\Facades\File::exists($oldImage)) {
                \Illuminate\Support\Facades\File::delete($oldImage);
            }

            $about->img = 'uploads/about/'.$filename;
        }

        $about->save();

        return redirect()->back()->with('success', 'اطلاعات درباره ما با موفقیت ذخیره شد.');
    }
}
