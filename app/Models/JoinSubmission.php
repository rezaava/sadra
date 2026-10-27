<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinSubmission extends Model
{
    protected $fillable = [
        'name',
        'father_name',
        'national_id',
        'birth_certificate_number',
        'birth_date',
        'birth_place',
        'certificate_issue_place',
        'certificate_issue_date',
        'religion',
        'nationality',
        'marital_status',
        'health_status',
        'health_description',
        'education_records',
        'work_experiences',
        'languages',
        'other_courses',
        'computer_skills',
        'computer_other',
        'training_courses',
        'cooperation_types',
        'part_time_schedule',
        'requested_job',
        'available_from',
        'has_insurance_history',
        'insurance_years',
        'how_found_company',
        'references',
        'currently_employed',
        'career_plan',
        'prepared_for_job',
        'experienced_software',
        'expected_salary',
        'residence_type',
        'residence_address',
        'landline',
        'phone',
        'email',
        'residence_description',
        'signature_name',
        'signature_date',
        'interview_result',
        'interviewer',
        'interviewer_signature',
    ];

    protected $casts = [
        'education_records' => 'array',
        'work_experiences' => 'array',
        'languages' => 'array',
        'other_courses' => 'array',
        'computer_skills' => 'array',
        'training_courses' => 'array',
        'cooperation_types' => 'array',
        'references' => 'array',

        'birth_date' => 'date',
        'certificate_issue_date' => 'date',
        'available_from' => 'date',
        'signature_date' => 'date',

        'health_status' => 'boolean',
        'has_insurance_history' => 'boolean',
        'currently_employed' => 'boolean',
    ];
}