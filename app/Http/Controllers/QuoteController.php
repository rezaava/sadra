<?php

namespace App\Http\Controllers;

use App\Models\QuoteSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    public function index()
    {
        return view('pages.quote');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'category' => ['required', 'in:carton,agriculture,pharma,hygiene,industrial,other'],
            'packaging' => ['required', 'in:export-carton,gift-box,die-cut'],
            'sheet' => ['nullable', 'in:3-layer,5-layer'],
            'quantity' => ['required', 'in:lt1000,1k-5k,5k-20k,gt20k'],
            'timeline' => ['nullable', 'in:urgent,1to2m,2to3m,unsure'],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:10240'],
            'message' => ['nullable', 'string', 'max:5000'],
            'consent' => ['required', 'accepted'],
        ], [
            'name.required' => 'لطفاً نام و نام خانوادگی را وارد کنید.',
            'brand.required' => 'لطفاً نام برند یا شرکت را وارد کنید.',
            'email.required' => 'لطفاً ایمیل را وارد کنید.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'phone.required' => 'لطفاً شماره تماس را وارد کنید.',
            'category.required' => 'لطفاً نوع محصول را انتخاب کنید.',
            'category.in' => 'نوع محصول انتخاب‌شده معتبر نیست.',
            'packaging.required' => 'لطفاً نوع بسته‌بندی را انتخاب کنید.',
            'packaging.in' => 'نوع بسته‌بندی انتخاب‌شده معتبر نیست.',
            'quantity.required' => 'لطفاً تیراژ تقریبی را انتخاب کنید.',
            'quantity.in' => 'تیراژ انتخاب‌شده معتبر نیست.',
            'timeline.in' => 'زمان‌بندی انتخاب‌شده معتبر نیست.',
            'dimensions.max' => 'ابعاد نباید بیشتر از 255 کاراکتر باشد.',
            'file.mimes' => 'فایل باید PDF یا تصویر باشد.',
            'file.max' => 'حجم فایل نباید بیشتر از 10 مگابایت باشد.',
            'message.max' => 'توضیحات نباید بیشتر از 5000 کاراکتر باشد.',
            'consent.required' => 'تأیید قوانین ارسال فرم الزامی است.',
            'consent.accepted' => 'برای ارسال فرم باید با استفاده از اطلاعات موافقت کنید.',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $directory = public_path('quotes');

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $file = $request->file('file');
            $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($directory, $fileName);
            $filePath = 'quotes/'.$fileName;
        }

        do {
            $trackingCode = 'SD-'.strtoupper(Str::random(8));
        } while (QuoteSubmission::where('tracking_code', $trackingCode)->exists());

        QuoteSubmission::create([
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'category' => $validated['category'],
            'packaging' => $validated['packaging'],
            'sheet' => $validated['sheet'] ?? null,
            'quantity' => $validated['quantity'],
            'timeline' => $validated['timeline'] ?? null,
            'dimensions' => $validated['dimensions'] ?? null,
            'file' => $filePath,
            'message' => $validated['message'] ?? null,
            'tracking_code' => $trackingCode,
        ]);

        return redirect()
            ->route('quote')
            ->with('success', 'درخواست استعلام شما با موفقیت ثبت شد.')
            ->with('tracking_code', $trackingCode);
    }
}
