<?php

namespace Database\Seeders;

use App\Models\Therapist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TherapistSeeder extends Seeder
{
    public function run(): void
    {
        $therapists = [
    [
        'first_name'     => 'Lina',
        'last_name'      => 'Khaled',
        'email'          => 'linaTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Stress Management',
        'language'       => 'English',
        'rating'         => 5,
        'is_available'   => true,
        'session_fee'    => 140.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Omar',
        'last_name'      => 'Youssef',
        'email'          => 'omarTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Anxiety & Panic Disorders',
        'language'       => 'Arabic',
        'rating'         => 4,
        'is_available'   => true,
        'session_fee'    => 130.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Nour',
        'last_name'      => 'Samir',
        'email'          => 'nourTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Sleep Disorders',
        'language'       => 'English',
        'rating'         => 3,
        'is_available'   => true,
        'session_fee'    => 160.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Yara',
        'last_name'      => 'Adel',
        'email'          => 'yaraTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Depression & Mood Disorders',
        'language'       => 'Arabic',
        'rating'         => 5,
        'is_available'   => true,
        'session_fee'    => 150.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Karim',
        'last_name'      => 'Mahmoud',
        'email'          => 'karimTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Social & Relationship Therapy',
        'language'       => 'English',
        'rating'         => 2,
        'is_available'   => true,
        'session_fee'    => 125.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Mariam',
        'last_name'      => 'Fathy',
        'email'          => 'mariamTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Trauma & PTSD',
        'language'       => 'Arabic',
        'rating'         => 4,
        'is_available'   => true,
        'session_fee'    => 170.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Hassan',
        'last_name'      => 'Nabil',
        'email'          => 'hassanTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Behavioral & Lifestyle Therapy',
        'language'       => 'English',
        'rating'         => 4,
        'is_available'   => true,
        'session_fee'    => 110.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Salma',
        'last_name'      => 'Ibrahim',
        'email'          => 'salmaTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Stress Management',
        'language'       => 'Arabic',
        'rating'         => 4,
        'is_available'   => true,
        'session_fee'    => 145.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Ali',
        'last_name'      => 'Mostafa',
        'email'          => 'aliTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Sleep Disorders',
        'language'       => 'English',
        'rating'         => 4,
        'is_available'   => true,
        'session_fee'    => 135.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],

    [
        'first_name'     => 'Dina',
        'last_name'      => 'Wael',
        'email'          => 'dinaTherapist@gmail.com',
        'password'       => Hash::make('password123'),
        'specialization' => 'Anxiety & Panic Disorders',
        'language'       => 'Arabic',
        'rating'         => 5,
        'is_available'   => true,
        'session_fee'    => 155.00,
        'wallet'         => 0,
        'total_patients' => 0,
        'total_sessions' => 0,
    ],
        ];

        foreach ($therapists as $therapist) {
            Therapist::firstOrCreate(
                ['email' => $therapist['email']],
                $therapist
            );
        }
    }
}
