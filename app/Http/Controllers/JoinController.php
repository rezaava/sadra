<?php

namespace App\Http\Controllers;

use App\Models\JoinSubmission;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        return view('pages.join');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'string',
                'max:30',
            ],

            'field' => [
                'required',
                'in:graphic,structure,production,marketing,internship,other',
            ],

            'experience' => [
                'nullable',
                'in:lt1,1to3,3to5,gt5',
            ],

            'portfolio' => [
                'nullable',
                'url',
                'max:500',
            ],

            'resume' => [
                'nullable',
                'file',
                'mimes:pdf',
            ],

            'message' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'consent' => [
                'required',
                'accepted',
            ],
        ], [
            'name.required' => 'لطفاً نام و نام خانوادگی را وارد کنید.',
            'email.required' => 'لطفاً ایمیل را وارد کنید.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'phone.required' => 'لطفاً شماره تماس را وارد کنید.',
            'field.required' => 'لطفاً حوزه مورد علاقه را انتخاب کنید.',
            'field.in' => 'حوزه انتخاب‌شده معتبر نیست.',
            'experience.in' => 'مقدار سابقه کار معتبر نیست.',
            'portfolio.url' => 'لطفاً یک لینک معتبر برای نمونه‌کار وارد کنید.',
            'resume.mimes' => 'فایل رزومه باید با فرمت PDF باشد.',
            'resume.max' => 'حجم فایل رزومه نباید بیشتر از 10 مگابایت باشد.',
            'message.max' => 'توضیحات نباید بیشتر از 5000 کاراکتر باشد.',
            'consent.required' => 'تأیید قوانین ارسال فرم الزامی است.',
            'consent.accepted' => 'برای ارسال فرم باید با استفاده از اطلاعات موافقت کنید.',
        ]);

        $resumePath = null;

        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');

            $fileName = time()
                . '_'
                . uniqid()
                . '.'
                . $resume->getClientOriginalExtension();

            $resume->move(
                ('resumes'),
                $fileName
            );

            $resumePath = 'resumes/' . $fileName;
        }

        JoinSubmission::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'field' => $validated['field'],
            'experience' => $validated['experience'] ?? null,
            'portfolio' => $validated['portfolio'] ?? null,
            'resume' => $resumePath,
            'message' => $validated['message'] ?? null,
        ]);

        return redirect()
            ->route('join')
            ->with('success', 'درخواست همکاری شما با موفقیت ثبت شد.');
    }
}