<?php

namespace App\Http\Controllers;

use App\Models\PortfolioSubmission;
use Illuminate\Http\Request;

class SubmitPortfolioController extends Controller
{
    public function index()
    {
        return view('pages.submit-portfolio');
    }

    public function store(Request $request)
    {
        // اول Validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'link' => ['required', 'url', 'max:500'],
            'field' => [
                'required',
                'in:graphic,structure,illustration,photography,other'
            ],
            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:10240'
            ],
            'message' => ['nullable', 'string', 'max:5000'],
            'consent' => ['required', 'accepted'],
        ], [
            'name.required' => 'لطفاً نام و نام خانوادگی را وارد کنید.',
            'email.required' => 'لطفاً ایمیل را وارد کنید.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'link.required' => 'لطفاً لینک نمونه‌کار را وارد کنید.',
            'link.url' => 'لطفاً یک لینک معتبر وارد کنید.',
            'field.required' => 'لطفاً حوزه فعالیت را انتخاب کنید.',
            'field.in' => 'حوزه فعالیت انتخاب‌شده معتبر نیست.',
            'file.mimes' => 'فایل باید PDF یا تصویر باشد.',
            'file.max' => 'حجم فایل نباید بیشتر از 10 مگابایت باشد.',
            'consent.required' => 'تأیید قوانین ارسال نمونه‌کار الزامی است.',
            'consent.accepted' => 'برای ارسال نمونه‌کار باید قوانین را تأیید کنید.',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(
                ('portfolio'),
                $fileName
            );

            $filePath = 'portfolio/' . $fileName;
        }

        // ذخیره اطلاعات در دیتابیس
        $submission = new PortfolioSubmission();

        $submission->name = $validated['name'];
        $submission->email = $validated['email'];
        $submission->link = $validated['link'];
        $submission->field = $validated['field'];
        $submission->file = $filePath;
        $submission->message = $validated['message'] ?? null;

        $submission->save();

        return redirect()
            ->route('submit-portfolio')
            ->with('success', 'نمونه‌کار شما با موفقیت ارسال شد.');
    }
}