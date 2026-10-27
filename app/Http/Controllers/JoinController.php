<?php

namespace App\Http\Controllers;

use App\Models\JoinSubmission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JoinController extends Controller
{
    public function index()
    {
        return view('pages.join');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 1. اطلاعات شخصی
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'national_id' => ['nullable', 'string', 'max:20'],
            'birth_certificate_number' => ['nullable', 'string', 'max:30'],
            'birth_date' => ['nullable', 'date'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'certificate_issue_place' => ['nullable', 'string', 'max:255'],
            'certificate_issue_date' => ['nullable', 'date'],
            'religion' => ['nullable', 'string', 'max:100'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'marital_status' => ['nullable', Rule::in(['single', 'married'])],
            'health_status' => ['nullable', 'boolean'],
            'health_description' => ['nullable', 'string', 'max:3000'],

            // 2. سوابق تحصیلی
            'education_records' => ['nullable', 'array'],
            'education_records.*.degree' => ['nullable', 'string', 'max:255'],
            'education_records.*.field' => ['nullable', 'string', 'max:255'],
            'education_records.*.institution' => ['nullable', 'string', 'max:255'],

            // 3. سوابق شغلی
            'work_experiences' => ['nullable', 'array'],
            'work_experiences.*.company' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.position' => ['nullable', 'string', 'max:255'],
            'work_experiences.*.duration' => ['nullable', 'string', 'max:100'],
            'work_experiences.*.start_date' => ['nullable', 'string', 'max:50'],
            'work_experiences.*.end_date' => ['nullable', 'string', 'max:50'],
            'work_experiences.*.salary' => ['nullable', 'string', 'max:100'],
            'work_experiences.*.leaving_reason' => ['nullable', 'string', 'max:1000'],

            // 4. زبان‌های خارجی
            'languages' => ['nullable', 'array'],
            'languages.*.name' => ['nullable', 'string', 'max:100'],
            'languages.*.speaking' => ['nullable', Rule::in(['weak', 'medium', 'good', 'excellent'])],
            'languages.*.writing' => ['nullable', Rule::in(['weak', 'medium', 'good', 'excellent'])],
            'languages.*.reading' => ['nullable', Rule::in(['weak', 'medium', 'good', 'excellent'])],

            'other_courses' => ['nullable', 'array'],
            'other_courses.*.name' => ['nullable', 'string', 'max:255'],

            // 5. مهارت‌های کامپیوتری
            'computer_skills' => ['nullable', 'array'],
            'computer_skills.*' => ['string', Rule::in([
                'windows',
                'access',
                'excel',
                'word',
                'internet',
                'powerpoint',
                'typing',
            ])],
            'computer_other' => ['nullable', 'string', 'max:1000'],

            'training_courses' => ['nullable', 'array'],
            'training_courses.*.name' => ['nullable', 'string', 'max:255'],
            'training_courses.*.institution' => ['nullable', 'string', 'max:255'],
            'training_courses.*.duration' => ['nullable', 'string', 'max:100'],
            'training_courses.*.start_date' => ['nullable', 'string', 'max:50'],
            'training_courses.*.end_date' => ['nullable', 'string', 'max:50'],
            'training_courses.*.description' => ['nullable', 'string', 'max:1000'],

            // 6. نحوه همکاری
            'cooperation_types' => ['nullable', 'array'],
            'cooperation_types.*' => ['string', Rule::in([
                'full_time',
                'part_time',
                'off_site',
            ])],
            'part_time_schedule' => ['nullable', 'string', 'max:2000'],

            // 7 تا 9
            'requested_job' => ['nullable', 'string', 'max:255'],
            'available_from' => ['nullable', 'date'],
            'has_insurance_history' => ['nullable', 'boolean'],
            'insurance_years' => ['nullable', 'string', 'max:100'],
            'how_found_company' => ['nullable', 'string', 'max:2000'],

            // 10. معرف‌ها
            'references' => ['nullable', 'array'],
            'references.*.name' => ['nullable', 'string', 'max:255'],
            'references.*.relation' => ['nullable', 'string', 'max:255'],
            'references.*.job' => ['nullable', 'string', 'max:255'],
            'references.*.workplace_address' => ['nullable', 'string', 'max:1000'],
            'references.*.phone' => ['nullable', 'string', 'max:30'],

            // 11 تا 15
            'currently_employed' => ['nullable', 'boolean'],
            'career_plan' => ['nullable', 'string', 'max:3000'],
            'prepared_for_job' => ['nullable', 'string', 'max:3000'],
            'experienced_software' => ['nullable', 'string', 'max:3000'],
            'expected_salary' => ['nullable', 'string', 'max:100'],

            // 16. نشانی و تماس
            'residence_type' => ['nullable', Rule::in([
                'personal',
                'rented',
                'other',
            ])],
            'residence_address' => ['nullable', 'string', 'max:3000'],
            'landline' => ['nullable', 'string', 'max:30'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'residence_description' => ['nullable', 'string', 'max:1000'],

            // تأیید متقاضی
            'signature_name' => ['nullable', 'string', 'max:255'],
            'signature_date' => ['nullable', 'date'],
            'consent' => ['required', 'accepted'],
        ], [
            'name.required' => 'لطفاً نام و نام خانوادگی را وارد کنید.',
            'phone.required' => 'لطفاً شماره تلفن همراه را وارد کنید.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'consent.required' => 'تأیید صحت اطلاعات الزامی است.',
            'consent.accepted' => 'برای ارسال فرم، تأیید صحت اطلاعات الزامی است.',
            'birth_date.date' => 'تاریخ تولد معتبر نیست.',
            'available_from.date' => 'تاریخ شروع به کار معتبر نیست.',
            'signature_date.date' => 'تاریخ تأیید معتبر نیست.',
        ]);

        $validated['health_status'] = $request->has('health_status')
            ? (bool) $request->input('health_status')
            : null;

        $validated['has_insurance_history'] = $request->has('has_insurance_history')
            ? (bool) $request->input('has_insurance_history')
            : null;

        $validated['currently_employed'] = $request->has('currently_employed')
            ? (bool) $request->input('currently_employed')
            : null;

        unset($validated['consent']);

        $submission = new JoinSubmission;

        $submission->name = $validated['name'];
        $submission->father_name = $validated['father_name'] ?? null;
        $submission->national_id = $validated['national_id'] ?? null;
        $submission->birth_certificate_number = $validated['birth_certificate_number'] ?? null;
        $submission->birth_date = $validated['birth_date'] ?? null;
        $submission->birth_place = $validated['birth_place'] ?? null;
        $submission->certificate_issue_place = $validated['certificate_issue_place'] ?? null;
        $submission->certificate_issue_date = $validated['certificate_issue_date'] ?? null;
        $submission->religion = $validated['religion'] ?? null;
        $submission->nationality = $validated['nationality'] ?? null;
        $submission->marital_status = $validated['marital_status'] ?? null;
        $submission->health_status = $validated['health_status'];
        $submission->health_description = $validated['health_description'] ?? null;

        $submission->education_records = $validated['education_records'] ?? null;
        $submission->work_experiences = $validated['work_experiences'] ?? null;
        $submission->languages = $validated['languages'] ?? null;
        $submission->other_courses = $validated['other_courses'] ?? null;
        $submission->computer_skills = $validated['computer_skills'] ?? null;
        $submission->computer_other = $validated['computer_other'] ?? null;
        $submission->training_courses = $validated['training_courses'] ?? null;

        $submission->cooperation_types = $validated['cooperation_types'] ?? null;
        $submission->part_time_schedule = $validated['part_time_schedule'] ?? null;
        $submission->requested_job = $validated['requested_job'] ?? null;
        $submission->available_from = $validated['available_from'] ?? null;
        $submission->has_insurance_history = $validated['has_insurance_history'];
        $submission->insurance_years = $validated['insurance_years'] ?? null;
        $submission->how_found_company = $validated['how_found_company'] ?? null;
        $submission->references = $validated['references'] ?? null;

        $submission->currently_employed = $validated['currently_employed'];
        $submission->career_plan = $validated['career_plan'] ?? null;
        $submission->prepared_for_job = $validated['prepared_for_job'] ?? null;
        $submission->experienced_software = $validated['experienced_software'] ?? null;
        $submission->expected_salary = $validated['expected_salary'] ?? null;

        $submission->residence_type = $validated['residence_type'] ?? null;
        $submission->residence_address = $validated['residence_address'] ?? null;
        $submission->landline = $validated['landline'] ?? null;
        $submission->phone = $validated['phone'];
        $submission->email = $validated['email'] ?? null;
        $submission->residence_description = $validated['residence_description'] ?? null;

        $submission->signature_name = $validated['signature_name'] ?? null;
        $submission->signature_date = $validated['signature_date'] ?? null;

        $submission->save();

        return redirect()
            ->route('join')
            ->with('success', 'فرم استخدام شما با موفقیت ثبت شد.');
    }
}
