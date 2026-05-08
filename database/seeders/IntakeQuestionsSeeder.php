<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IntakeQuestion; 

class IntakeQuestionsSeeder extends Seeder
{

    public function run(): void
    {
    
    $questions = [

    [
        'question_text' => 'How often do you feel stressed?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Rarely',    'score' => 1],
            ['option_text' => 'Sometimes', 'score' => 2],
            ['option_text' => 'Often',     'score' => 3],
            ['option_text' => 'Always',    'score' => 4],
        ]
    ],
    [
        'question_text' => 'How difficult is it for you to relax after a stressful day?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Not difficult at all', 'score' => 1],
            ['option_text' => 'Slightly difficult',   'score' => 2],
            ['option_text' => 'Quite difficult',      'score' => 3],
            ['option_text' => 'Extremely difficult',  'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel overwhelmed by your daily responsibilities?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Never',      'score' => 1],
            ['option_text' => 'Rarely',     'score' => 2],
            ['option_text' => 'Often',      'score' => 3],
            ['option_text' => 'All the time','score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you experience physical symptoms of stress (headaches, tight muscles)?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Never',     'score' => 1],
            ['option_text' => 'Sometimes', 'score' => 2],
            ['option_text' => 'Weekly',    'score' => 3],
            ['option_text' => 'Daily',     'score' => 4],
        ]
    ],
    [
        'question_text' => 'How well do you cope when unexpected problems arise?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Very well',          'score' => 1],
            ['option_text' => 'Fairly well',        'score' => 2],
            ['option_text' => 'With some difficulty','score' => 3],
            ['option_text' => 'Very poorly',        'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you find yourself worrying about things you cannot control?',
        'category' => 'stress',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Occasionally',   'score' => 2],
            ['option_text' => 'Frequently',     'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],

    // ===== ANXIETY (6 questions) =====
    [
        'question_text' => 'Do you experience anxiety in daily situations?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Never',      'score' => 1],
            ['option_text' => 'Sometimes',  'score' => 2],
            ['option_text' => 'Frequently', 'score' => 3],
            ['option_text' => 'Always',     'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you avoid certain places or situations due to fear or anxiety?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Never',           'score' => 1],
            ['option_text' => 'Occasionally',    'score' => 2],
            ['option_text' => 'Often',           'score' => 3],
            ['option_text' => 'Almost always',   'score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you experience sudden feelings of panic or intense fear?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Never',          'score' => 1],
            ['option_text' => 'Once a month',   'score' => 2],
            ['option_text' => 'Once a week',    'score' => 3],
            ['option_text' => 'Multiple times a week', 'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel nervous or on edge without a clear reason?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Often',          'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],
    [
        'question_text' => 'How much does anxiety interfere with your work or social life?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Not at all',    'score' => 1],
            ['option_text' => 'A little',      'score' => 2],
            ['option_text' => 'Moderately',    'score' => 3],
            ['option_text' => 'Severely',      'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you find it difficult to control your worrying thoughts?',
        'category' => 'anxiety',
        'options' => [
            ['option_text' => 'Not difficult',           'score' => 1],
            ['option_text' => 'Slightly difficult',      'score' => 2],
            ['option_text' => 'Very difficult',          'score' => 3],
            ['option_text' => 'Completely uncontrollable','score' => 4],
        ]
    ],

    // ===== SLEEP (5 questions) =====
    [
        'question_text' => 'How would you rate your overall sleep quality?',
        'category' => 'sleep',
        'options' => [
            ['option_text' => 'Very Good', 'score' => 1],
            ['option_text' => 'Good',      'score' => 2],
            ['option_text' => 'Poor',      'score' => 3],
            ['option_text' => 'Very Poor', 'score' => 4],
        ]
    ],
    [
        'question_text' => 'How many hours of sleep do you usually get per night?',
        'category' => 'sleep',
        'options' => [
            ['option_text' => 'More than 8 hours', 'score' => 1],
            ['option_text' => '6–8 hours',         'score' => 2],
            ['option_text' => '4–6 hours',         'score' => 3],
            ['option_text' => 'Less than 4 hours', 'score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you have trouble falling asleep?',
        'category' => 'sleep',
        'options' => [
            ['option_text' => 'Rarely',     'score' => 1],
            ['option_text' => 'Sometimes',  'score' => 2],
            ['option_text' => 'Often',      'score' => 3],
            ['option_text' => 'Every night','score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you wake up during the night and struggle to fall back asleep?',
        'category' => 'sleep',
        'options' => [
            ['option_text' => 'Never',          'score' => 1],
            ['option_text' => 'Occasionally',   'score' => 2],
            ['option_text' => 'Several nights a week', 'score' => 3],
            ['option_text' => 'Every night',    'score' => 4],
        ]
    ],
    [
        'question_text' => 'How do you feel when you wake up in the morning?',
        'category' => 'sleep',
        'options' => [
            ['option_text' => 'Refreshed and energetic',  'score' => 1],
            ['option_text' => 'Fairly rested',            'score' => 2],
            ['option_text' => 'Tired',                    'score' => 3],
            ['option_text' => 'Exhausted',                'score' => 4],
        ]
    ],

    // ===== MOOD (5 questions) =====
    [
        'question_text' => 'How would you describe your general mood over the past two weeks?',
        'category' => 'mood',
        'options' => [
            ['option_text' => 'Mostly positive',  'score' => 1],
            ['option_text' => 'Neutral',           'score' => 2],
            ['option_text' => 'Often low',         'score' => 3],
            ['option_text' => 'Very low or hopeless','score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you feel sad or empty without a clear reason?',
        'category' => 'mood',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Most days',      'score' => 3],
            ['option_text' => 'Every day',      'score' => 4],
        ]
    ],
    [
        'question_text' => 'Have you lost interest in activities you used to enjoy?',
        'category' => 'mood',
        'options' => [
            ['option_text' => 'Not at all',         'score' => 1],
            ['option_text' => 'A little',           'score' => 2],
            ['option_text' => 'Significantly',      'score' => 3],
            ['option_text' => 'Completely',         'score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you feel irritable or easily frustrated?',
        'category' => 'mood',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Often',          'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel hopeful about your future?',
        'category' => 'mood',
        'options' => [
            ['option_text' => 'Very hopeful',       'score' => 1],
            ['option_text' => 'Somewhat hopeful',   'score' => 2],
            ['option_text' => 'Rarely hopeful',     'score' => 3],
            ['option_text' => 'Not hopeful at all', 'score' => 4],
        ]
    ],

    // ===== SOCIAL (5 questions) =====
    [
        'question_text' => 'How satisfied are you with your social relationships?',
        'category' => 'social',
        'options' => [
            ['option_text' => 'Very satisfied',     'score' => 1],
            ['option_text' => 'Somewhat satisfied', 'score' => 2],
            ['option_text' => 'Unsatisfied',        'score' => 3],
            ['option_text' => 'Very unsatisfied',   'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel lonely or isolated?',
        'category' => 'social',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Often',          'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],
    [
        'question_text' => 'How comfortable are you talking to others about your feelings?',
        'category' => 'social',
        'options' => [
            ['option_text' => 'Very comfortable',     'score' => 1],
            ['option_text' => 'Somewhat comfortable', 'score' => 2],
            ['option_text' => 'Uncomfortable',        'score' => 3],
            ['option_text' => 'I never do this',      'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do conflicts with others affect your mental well-being significantly?',
        'category' => 'social',
        'options' => [
            ['option_text' => 'Not really',     'score' => 1],
            ['option_text' => 'A little',       'score' => 2],
            ['option_text' => 'Quite a lot',    'score' => 3],
            ['option_text' => 'Overwhelmingly', 'score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you withdraw from social activities?',
        'category' => 'social',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Often',          'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],

    // ===== TRAUMA (4 questions) =====
    [
        'question_text' => 'Have you experienced a traumatic event in your life?',
        'category' => 'trauma',
        'options' => [
            ['option_text' => 'No',                          'score' => 1],
            ['option_text' => 'Yes, but it no longer affects me', 'score' => 2],
            ['option_text' => 'Yes, and it occasionally affects me', 'score' => 3],
            ['option_text' => 'Yes, and it affects me daily', 'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you experience unwanted flashbacks or intrusive memories?',
        'category' => 'trauma',
        'options' => [
            ['option_text' => 'Never',          'score' => 1],
            ['option_text' => 'Rarely',         'score' => 2],
            ['option_text' => 'Sometimes',      'score' => 3],
            ['option_text' => 'Frequently',     'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel emotionally numb or detached from your surroundings?',
        'category' => 'trauma',
        'options' => [
            ['option_text' => 'Never',          'score' => 1],
            ['option_text' => 'Occasionally',   'score' => 2],
            ['option_text' => 'Often',          'score' => 3],
            ['option_text' => 'Almost always',  'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you feel safe in your current living environment?',
        'category' => 'trauma',
        'options' => [
            ['option_text' => 'Completely safe',   'score' => 1],
            ['option_text' => 'Mostly safe',       'score' => 2],
            ['option_text' => 'Somewhat unsafe',   'score' => 3],
            ['option_text' => 'Very unsafe',       'score' => 4],
        ]
    ],

    // ===== SELF-CARE (4 questions) =====
    [
        'question_text' => 'How often do you engage in physical activity or exercise?',
        'category' => 'self_care',
        'options' => [
            ['option_text' => 'Daily',              'score' => 1],
            ['option_text' => 'A few times a week', 'score' => 2],
            ['option_text' => 'Rarely',             'score' => 3],
            ['option_text' => 'Never',              'score' => 4],
        ]
    ],
    [
        'question_text' => 'How would you rate your eating habits?',
        'category' => 'self_care',
        'options' => [
            ['option_text' => 'Very healthy',       'score' => 1],
            ['option_text' => 'Mostly healthy',     'score' => 2],
            ['option_text' => 'Unhealthy at times', 'score' => 3],
            ['option_text' => 'Very unhealthy',     'score' => 4],
        ]
    ],
    [
        'question_text' => 'Do you take time for hobbies or activities that bring you joy?',
        'category' => 'self_care',
        'options' => [
            ['option_text' => 'Regularly',      'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Rarely',         'score' => 3],
            ['option_text' => 'Never',          'score' => 4],
        ]
    ],
    [
        'question_text' => 'How often do you feel completely drained of energy?',
        'category' => 'self_care',
        'options' => [
            ['option_text' => 'Rarely',         'score' => 1],
            ['option_text' => 'Sometimes',      'score' => 2],
            ['option_text' => 'Most days',      'score' => 3],
            ['option_text' => 'Every day',      'score' => 4],
        ]
    ],
];

foreach ($questions as $index => $q) {
            $question = IntakeQuestion::create([
                'question_text' => $q['question_text'],
                'category'      => $q['category'],
                'order'         => $index + 1,
            ]);

            foreach ($q['options'] as $opt) {
                $question->options()->create($opt);
            }
        }
    }
}