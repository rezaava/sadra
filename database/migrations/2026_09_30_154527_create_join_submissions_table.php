
    
  
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('join_submissions', function (Blueprint $table) {
            $table->id();

            // 1. اطلاعات شخصی
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('national_id', 20)->nullable();
            $table->string('birth_certificate_number', 30)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('certificate_issue_place')->nullable();
            $table->date('certificate_issue_date')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->boolean('health_status')->nullable();
            $table->text('health_description')->nullable();

            // 2. سوابق تحصیلی و 3. سوابق شغلی
            $table->json('education_records')->nullable();
            $table->json('work_experiences')->nullable();

            // 4. زبان‌ها و مهارت‌های مرتبط
            $table->json('languages')->nullable();
            $table->json('other_courses')->nullable();

            // 5. مهارت‌های کامپیوتری و دوره‌های آموزشی
            $table->json('computer_skills')->nullable();
            $table->string('computer_other')->nullable();
            $table->json('training_courses')->nullable();

            // 6. نحوه همکاری
            $table->json('cooperation_types')->nullable();
            $table->text('part_time_schedule')->nullable();

            // 7 تا 9
            $table->string('requested_job')->nullable();
            $table->date('available_from')->nullable();
            $table->boolean('has_insurance_history')->nullable();
            $table->string('insurance_years')->nullable();
            $table->text('how_found_company')->nullable();

            // 10. معرف‌ها
            $table->json('references')->nullable();

            // 11 تا 15
            $table->boolean('currently_employed')->nullable();
            $table->text('career_plan')->nullable();
            $table->text('prepared_for_job')->nullable();
            $table->text('experienced_software')->nullable();
            $table->string('expected_salary')->nullable();

            // 16. اطلاعات محل سکونت و تماس
            $table->string('residence_type')->nullable();
            $table->text('residence_address')->nullable();
            $table->string('landline', 30)->nullable();
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->text('residence_description')->nullable();

            // تأیید متقاضی و بخش مخصوص شرکت
            $table->string('signature_name')->nullable();
            $table->date('signature_date')->nullable();
            $table->text('interview_result')->nullable();
            $table->string('interviewer')->nullable();
            $table->string('interviewer_signature')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('join_submissions');
    }
};
