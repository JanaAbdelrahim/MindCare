<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $therapist_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property string $status
 * @property int|null $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PatientSession|null $session
 * @property-read \App\Models\Therapist $therapist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AvailabilitySlot whereUpdatedAt($value)
 */
	class AvailabilitySlot extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Complaint whereUpdatedAt($value)
 */
	class Complaint extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property string $description
 * @property string $status
 * @property int $progress_days
 * @property int $target_days
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereProgressDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereTargetDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Goal whereUpdatedAt($value)
 */
	class Goal extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int $intake_question_id
 * @property int $intake_option_id
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IntakeOption $option
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\IntakeQuestion $question
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereIntakeOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereIntakeQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeAnswer whereUpdatedAt($value)
 */
	class IntakeAnswer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int $stress_score
 * @property int $anxiety_score
 * @property int $sleep_score
 * @property int $mood_score
 * @property int $social_score
 * @property int $trauma_score
 * @property int $self_care_score
 * @property string $overall_level
 * @property string|null $recommended_specialization
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Report|null $report
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereAnxietyScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereMoodScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereOverallLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereRecommendedSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereSelfCareScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereSleepScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereSocialScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereStressScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereTraumaScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeForm whereUpdatedAt($value)
 */
	class IntakeForm extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $intake_question_id
 * @property string $option_text
 * @property int $score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IntakeQuestion $question
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereIntakeQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereOptionText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeOption whereUpdatedAt($value)
 */
	class IntakeOption extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $question_text
 * @property string $category
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IntakeAnswer> $answers
 * @property-read int|null $answers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IntakeOption> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereQuestionText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntakeQuestion whereUpdatedAt($value)
 */
	class IntakeQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $therapist_id
 * @property int|null $session_id
 * @property int|null $patient_id
 * @property string $user_type
 * @property string $message
 * @property int $is_read
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @property-read \App\Models\PatientSession|null $session
 * @property-read \App\Models\Therapist|null $therapist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUserType($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property int|null $age
 * @property string|null $condition_level
 * @property numeric $wallet
 * @property int|null $therapist_id
 * @property int $total_sessions
 * @property string|null $date_of_birth
 * @property string|null $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Complaint> $complaints
 * @property-read int|null $complaints_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Goal> $goals
 * @property-read int|null $goals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IntakeAnswer> $intakeAnswers
 * @property-read int|null $intake_answers_count
 * @property-read \App\Models\IntakeForm|null $intakeForm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSession> $sessions
 * @property-read int|null $sessions_count
 * @property-read \App\Models\Therapist|null $therapist
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WellnessRecord> $wellnessRecords
 * @property-read int|null $wellness_records_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereConditionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereTotalSessions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereWallet($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $therapist_id
 * @property int $patient_id
 * @property string $session_time
 * @property string|null $notes
 * @property string $status
 * @property string|null $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AvailabilitySlot|null $availabilitySlot
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\Therapist $therapist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereSessionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PatientSession whereUpdatedAt($value)
 */
	class PatientSession extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $therapist_id
 * @property int $patient_id
 * @property numeric $amount
 * @property string $status
 * @property string $payment_method
 * @property int $session_id
 * @property string|null $transaction_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\PatientSession $session
 * @property-read \App\Models\Therapist $therapist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int|null $therapist_id
 * @property int $intake_form_id
 * @property int $total_score
 * @property string $condition_level
 * @property string|null $recommended_specialization
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IntakeForm $intakeForm
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Therapist|null $therapist
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereConditionLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereIntakeFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereRecommendedSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereTherapistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Report whereUpdatedAt($value)
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $specialization
 * @property string $language
 * @property string $rating
 * @property int $is_available
 * @property numeric $wallet
 * @property numeric $session_fee
 * @property int $total_patients
 * @property int $total_sessions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AvailabilitySlot> $availabilitySlots
 * @property-read int|null $availability_slots_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Patient> $patients
 * @property-read int|null $patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PatientSession> $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereSessionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereTotalPatients($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereTotalSessions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Therapist whereWallet($value)
 */
	class Therapist extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int|null $mood_score
 * @property numeric|null $sleep_quality
 * @property string|null $journal_entry
 * @property string $visibility
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereJournalEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereMoodScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereSleepQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WellnessRecord whereVisibility($value)
 */
	class WellnessRecord extends \Eloquent {}
}

