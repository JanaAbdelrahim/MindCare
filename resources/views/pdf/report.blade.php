<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report – {{ $report->patient?->first_name }} {{ $report->patient?->last_name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            background: #fff;
            color: #354650;
            font-size: 13px;
            line-height: 1.6;
        }

        .header {
            background: #5D768B;
            color: #fff;
            padding: 28px 36px;
            border-radius: 0 0 16px 16px;
        }
        .header h1 { font-size: 22px; margin-bottom: 4px; }
        .header p  { font-size: 13px; opacity: .85; }

        .content { padding: 28px 36px; }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #5D768B;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 2px solid #EDF5FB;
            padding-bottom: 6px;
            margin-bottom: 14px;
        }

        .grid { width: 100%; margin-bottom: 24px; }
        .grid td { width: 50%; vertical-align: top; padding-right: 16px; }
        .grid td:last-child { padding-right: 0; }

        .card {
            background: #FDFCFA;
            border: 1px solid #e8e1d7;
            border-radius: 12px;
            padding: 16px;
        }

        .field { margin-bottom: 10px; }
        .field .label { font-size: 11px; color: #83919a; text-transform: uppercase; letter-spacing: .4px; }
        .field .value { font-size: 13px; color: #354650; font-weight: 600; }

        .pill {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .pill-low    { background: #EAF3F0; color: #6B9A8B; }
        .pill-medium { background: #FFF8ED; color: #A87538; }
        .pill-high   { background: #FFEFE2; color: #B5653D; }
        .pill-severe { background: #FFE5E5; color: #C74747; }

        .notes-box {
            background: #F8F5F1;
            border-left: 4px solid #5D768B;
            border-radius: 0 10px 10px 0;
            padding: 14px 18px;
            font-size: 13px;
            color: #4f4f4f;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .footer {
            margin-top: 36px;
            padding-top: 14px;
            border-top: 1px solid #e8e1d7;
            font-size: 11px;
            color: #83919a;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>MindCare — Clinical Report</h1>
        <p>Generated {{ $report->created_at?->format('F d, Y') }} &nbsp;|&nbsp;
        Therapist: Dr. {{ $report->therapist?->first_name }} {{ $report->therapist?->last_name }}</p>
    </div>

    <div class="content">

        {{-- Patient + Assessment side by side --}}
        <table class="grid">
            <tr>
                {{-- Patient Info --}}
                <td>
                    <div class="card">
                        <div class="section-title">Patient Information</div>

                        <div class="field">
                            <div class="label">Full Name</div>
                            <div class="value">{{ $report->patient?->first_name }} {{ $report->patient?->last_name }}</div>
                        </div>

                        <div class="field">
                            <div class="label">Intake Form Date</div>
                            <div class="value">{{ $report->intakeForm?->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                        </div>

                        <div class="field">
                            <div class="label">Report Date</div>
                            <div class="value">{{ $report->created_at?->format('M d, Y') }}</div>
                        </div>
                    </div>
                </td>

                {{-- Assessment --}}
                <td>
                    <div class="card">
                        <div class="section-title">Assessment</div>

                        <div class="field">
                            <div class="label">Total Score</div>
                            <div class="value">{{ $report->total_score }}</div>
                        </div>

                        <div class="field">
                            <div class="label">Condition Level</div>
                            <div class="value">
                                <span class="pill pill-{{ $report->condition_level }}">
                                    {{ ucfirst($report->condition_level) }}
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <div class="label">Recommended Specialization</div>
                            <div class="value">{{ $report->recommended_specialization ?: 'Not specified' }}</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-title">Clinical Notes</div>
        <div class="notes-box">{{ $report->notes ?: 'No clinical notes recorded for this report.' }}</div>

        {{-- Footer --}}
        <div class="footer">
            MindCare Confidential &nbsp;|&nbsp; This document is intended for clinical use only
        </div>

    </div>

</body>
</html>
