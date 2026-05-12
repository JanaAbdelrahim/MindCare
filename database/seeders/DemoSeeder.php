<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Therapist;
use App\Models\Patient;
use App\Models\PatientSession;
use App\Models\AvailabilitySlot;
use App\Models\WellnessRecord;
use App\Models\IntakeForm;
use App\Models\Payment;
use App\Models\Report;

class DemoSeeder extends Seeder
{

    public function run(): void
    {

        $patientsData = [
            [
                'first_name'      => 'Ahmed',
                'last_name'       => 'Hassan',
                'email'           => 'ahmed.patient@gmail.com',
                'password'        => Hash::make('password123'),
                'age'             => 28,
                'gender'          => 'male',
                'date_of_birth'   => '1996-03-15',
                'condition_level' => 'medium',
                'wallet'          => 500.00,
            ],
            [
                'first_name'      => 'Sara',
                'last_name'       => 'Mohamed',
                'email'           => 'sara.patient@gmail.com',
                'password'        => Hash::make('password123'),
                'age'             => 24,
                'gender'          => 'female',
                'date_of_birth'   => '2000-07-22',
                'condition_level' => 'high',
                'wallet'          => 300.00,
            ],
            [
                'first_name'      => 'Khaled',
                'last_name'       => 'Ali',
                'email'           => 'khaled.patient@gmail.com',
                'password'        => Hash::make('password123'),
                'age'             => 35,
                'gender'          => 'male',
                'date_of_birth'   => '1989-11-05',
                'condition_level' => 'low',
                'wallet'          => 800.00,
            ],
            [
                'first_name'      => 'Nadia',
                'last_name'       => 'Youssef',
                'email'           => 'nadia.patient@gmail.com',
                'password'        => Hash::make('password123'),
                'age'             => 31,
                'gender'          => 'female',
                'date_of_birth'   => '1993-05-18',
                'condition_level' => 'severe',
                'wallet'          => 200.00,
            ],
            [
                'first_name'      => 'Omar',
                'last_name'       => 'Farouk',
                'email'           => 'omar.patient@gmail.com',
                'password'        => Hash::make('password123'),
                'age'             => 22,
                'gender'          => 'male',
                'date_of_birth'   => '2002-01-30',
                'condition_level' => 'medium',
                'wallet'          => 650.00,
            ],
        ];

        $patients = [];
        foreach ($patientsData as $data) {
            $patients[] = Patient::firstOrCreate(['email' => $data['email']], $data);
        }

        $therapists = Therapist::orderBy('id')->take(3)->get();

        if ($therapists->isEmpty()) {
            $this->command->warn('No therapists found — run TherapistSeeder first.');
            return;
        }

        foreach ($patients as $i => $patient) {
            $therapist = $therapists[$i % $therapists->count()];
            $patient->update(['therapist_id' => $therapist->id]);
        }

        $intakeLevels = [
            ['stress'=>3,'anxiety'=>4,'sleep'=>2,'mood'=>3,'social'=>2,'trauma'=>1,'self_care'=>3,'level'=>'medium','spec'=>'Anxiety & Panic Disorders'],
            ['stress'=>5,'anxiety'=>5,'sleep'=>4,'mood'=>5,'social'=>3,'trauma'=>2,'self_care'=>4,'level'=>'high','spec'=>'Depression & Mood Disorders'],
            ['stress'=>1,'anxiety'=>1,'sleep'=>1,'mood'=>2,'social'=>1,'trauma'=>0,'self_care'=>1,'level'=>'low','spec'=>'Stress Management'],
            ['stress'=>5,'anxiety'=>5,'sleep'=>5,'mood'=>5,'social'=>5,'trauma'=>5,'self_care'=>5,'level'=>'severe','spec'=>'Trauma & PTSD'],
            ['stress'=>3,'anxiety'=>2,'sleep'=>3,'mood'=>3,'social'=>2,'trauma'=>1,'self_care'=>2,'level'=>'medium','spec'=>'Sleep Disorders'],
        ];

        $intakeForms = [];
        foreach ($patients as $i => $patient) {
            $d = $intakeLevels[$i];
            $intakeForms[] = IntakeForm::firstOrCreate(
                ['patient_id' => $patient->id],
                [
                    'stress_score'               => $d['stress'],
                    'anxiety_score'              => $d['anxiety'],
                    'sleep_score'                => $d['sleep'],
                    'mood_score'                 => $d['mood'],
                    'social_score'               => $d['social'],
                    'trauma_score'               => $d['trauma'],
                    'self_care_score'            => $d['self_care'],
                    'overall_level'              => $d['level'],
                    'recommended_specialization' => $d['spec'],
                ]
            );
        }

        $slotHours = [9, 11, 14, 16];

        foreach ($therapists as $therapist) {
            for ($day = 0; $day <= 13; $day++) {
                foreach ($slotHours as $hour) {
                    $start = Carbon::now()->addDays($day)->setTime($hour, 0, 0);
                    $end   = $start->copy()->addHour();

                    $exists = AvailabilitySlot::where('therapist_id', $therapist->id)
                        ->where('start_time', $start)
                        ->exists();

                    if (!$exists) {
                        AvailabilitySlot::create([
                            'therapist_id' => $therapist->id,
                            'start_time'   => $start,
                            'end_time'     => $end,
                            'status'       => 'available',
                        ]);
                    }
                }
            }
        }

        $sessionConfigs = [
            [0, 0, -14, 'completed', 5,    'Patient showed significant improvement in stress management techniques.'],
            [0, 0,  -7, 'completed', 4,    'Discussed coping mechanisms for workplace anxiety. Progress noted.'],
            [0, 0,   3, 'scheduled', null, null],

            [1, 1, -21, 'completed', 3,    'Initial session. Patient is struggling with severe anxiety episodes.'],
            [1, 1, -14, 'completed', 4,    'CBT techniques introduced. Patient responding well.'],
            [1, 1,  -7, 'completed', 5,    'Major breakthrough — patient managed a panic attack independently.'],
            [1, 1,   5, 'scheduled', null, null],

            [2, 2, -10, 'completed', 5,    'Patient maintaining excellent progress. Sleep hygiene much improved.'],
            [2, 2,   7, 'scheduled', null, null],

            [3, 0, -28, 'completed', 2,    'Very difficult session. Patient resistant to treatment plan.'],
            [3, 0, -21, 'completed', 3,    'Some improvement in willingness to engage.'],
            [3, 0, -14, 'completed', 4,    'Trauma processing underway. Steady progress.'],
            [3, 0,  -7, 'completed', 4,    'Patient demonstrating resilience and coping skills.'],
            [3, 0,   2, 'scheduled', null, null],

            [4, 1,  -5, 'completed', 4,    'Good engagement. Mood tracking started.'],
            [4, 1,   4, 'scheduled', null, null],
        ];

        $createdSessions = [];
        foreach ($sessionConfigs as $cfg) {
            [$pi, $ti, $dayOffset, $status, $rating, $notes] = $cfg;

            $patient     = $patients[$pi];
            $therapist   = $therapists[$ti];
            $sessionTime = Carbon::now()->addDays($dayOffset)->setTime(10, 0, 0);

            $session = PatientSession::firstOrCreate(
                [
                    'patient_id'   => $patient->id,
                    'therapist_id' => $therapist->id,
                    'session_time' => $sessionTime,
                ],
                [
                    'status' => $status,
                    'rating' => $rating,
                    'notes'  => $notes,
                ]
            );

            $createdSessions[] = compact('session', 'patient', 'therapist');

            if ($status === 'completed') {
                Payment::firstOrCreate(
                    ['session_id' => $session->id],
                    [
                        'patient_id'     => $patient->id,
                        'therapist_id'   => $therapist->id,
                        'amount'         => $therapist->session_fee,
                        'status'         => 'completed',
                        'payment_method' => $pi % 2 === 0 ? 'credit_card' : 'wallet',
                        'transaction_id' => 'TXN_DEMO_' . $session->id . '_' . uniqid(),
                    ]
                );
            }
        }

        foreach ($therapists as $therapist) {
            $avgRating = PatientSession::where('therapist_id', $therapist->id)
                ->whereNotNull('rating')
                ->avg('rating');

            if ($avgRating) {
                $therapist->update(['rating' => (int) round($avgRating)]);
            }
        }

        $moodArcs = [
            [3,3,4,4,4,5,5,4,5,5,4,5,5,5],
            [2,1,2,2,3,2,3,3,4,3,4,4,4,5],
            [4,5,5,4,5,4,5,5,4,5,5,4,5,5],
            [2,1,2,1,3,2,1,3,2,3,3,4,3,4],
            [3,3,3,4,3,4,4,4,5,4,5,4,5,5],
        ];

        $journalEntries = [
            'Today felt a bit overwhelming but I managed to use my breathing techniques.',
            'Had a good session with my therapist. Feeling more hopeful.',
            'Struggled with sleep again but the meditation helped a little.',
            'Really proud of how I handled that stressful meeting today.',
            'Feeling lighter. Journaling is becoming a habit I enjoy.',
            'Tough day. Reached out to a friend instead of isolating — progress!',
            'My therapist gave me new exercises. Looking forward to trying them.',
            'Energy levels are improving. Small wins count.',
            'Anxiety was manageable today. Noticed my triggers more clearly.',
            'Grateful for the support. Things are slowly getting better.',
        ];

        foreach ($patients as $i => $patient) {
            for ($day = 13; $day >= 0; $day--) {
                $date      = Carbon::now()->subDays($day);
                $moodScore = $moodArcs[$i][$day] ?? rand(3, 5);
                $journal   = $day % 2 === 0
                    ? $journalEntries[array_rand($journalEntries)]
                    : null;

                $exists = WellnessRecord::where('patient_id', $patient->id)
                    ->whereDate('created_at', $date->toDateString())
                    ->whereNotNull('mood_score')
                    ->exists();

                if (!$exists) {
                    WellnessRecord::create([
                        'patient_id'    => $patient->id,
                        'mood_score'    => $moodScore,
                        'sleep_quality' => round(rand(5, 9) * 0.5, 1),
                        'journal_entry' => $journal,
                        'visibility'    => 'therapist_only',
                        'created_at'    => $date,
                        'updated_at'    => $date,
                    ]);
                }
            }
        }

        $reportNotes = [
            "Patient demonstrates awareness of anxiety triggers. Recommended daily mindfulness exercises and structured sleep schedule. Progress trajectory is positive.",
            "Significant improvement noted since last intake. Patient is actively applying CBT strategies. Recommend continuation of weekly sessions.",
            "Patient presenting with high stress markers. Immediate focus on stabilization techniques. Refer to trauma-informed care track.",
            "Mood regulation improving steadily. Patient built a reliable support network. Reduce session frequency to bi-weekly.",
            "Sleep disturbances persist but with reduced severity. Recommend sleep hygiene protocol and possible referral to sleep specialist.",
        ];

        foreach ($patients as $i => $patient) {
            $therapist  = $therapists[$i % $therapists->count()];
            $intakeForm = $intakeForms[$i];

            $exists = Report::where('patient_id', $patient->id)
                ->where('therapist_id', $therapist->id)
                ->exists();

            if (!$exists) {
                Report::create([
                    'patient_id'                 => $patient->id,
                    'therapist_id'               => $therapist->id,
                    'intake_form_id'             => $intakeForm->id,
                    'total_score'                => $intakeLevels[$i]['stress']
                                                    + $intakeLevels[$i]['anxiety']
                                                    + $intakeLevels[$i]['sleep']
                                                    + $intakeLevels[$i]['mood'],
                    'condition_level'            => $intakeLevels[$i]['level'],
                    'recommended_specialization' => $intakeLevels[$i]['spec'],
                    'notes'                      => $reportNotes[$i],
                    'created_at'                 => Carbon::now()->subDays(rand(5, 20)),
                ]);
            }
        }

        $this->command->info(' DemoSeeder done:');
        $this->command->info('   • ' . count($patients)      . ' patients created');
        $this->command->info('   • ' . $therapists->count()  . ' therapists assigned slots (14 days × 4 slots)');
        $this->command->info('   • ' . count($sessionConfigs) . ' sessions created');
        $this->command->info('   • 14-day mood streak per patient');
        $this->command->info('   • ' . count($patients)      . ' reports created');
    }
}