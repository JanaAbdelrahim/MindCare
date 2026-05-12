<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MindCare</title>
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/plugins/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/CSS/reports-notifications.css') }}">
</head>

<body>
    @include('shared.nav')

    <main class="work-page my-5">
        <div class="container">
            <div class="mb-4">
                <h1 class="work-title">Availability Slots</h1>
                <p class="work-subtitle">Create appointment windows patients can book.</p>
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row g-4">
                <div class="col-lg-4">
                    <section class="soft-card">
                        <h3 class="mb-3">Add Slot</h3>
                        <form method="POST" action="{{ route('therapist.slots.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="start_time">Start time</label>
                                <input class="form-control" type="datetime-local" id="start_time" name="start_time"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="end_time">End time</label>
                                <input class="form-control" type="datetime-local" id="end_time" name="end_time"
                                    required>
                            </div>
                            <button class="mindcare-btn w-100" type="submit">Add Slot</button>
                        </form>
                    </section>
                </div>
                <div class="col-lg-8">
                    <section class="soft-card">
                        <div class="table-responsive">
                            <table class="table mindcare-table">
                                <thead>
                                    <tr>
                                        <th>START</th>
                                        <th>END</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($slots as $slot)
                                        <tr>
                                            <td>{{ $slot->start_time->setTimezone('Africa/Cairo')->format('M d, Y h:i A') }}
                                            </td>
                                            <td>{{ $slot->end_time->setTimezone('Africa/Cairo')->format('M d, Y h:i A') }}
                                            </td>
                                            <td><span
                                                    class="status-pill {{ $slot->status === 'available' ? 'read' : 'unread' }}">{{ ucfirst($slot->status) }}</span>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('therapist.slots.destroy', $slot) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mindcare-btn warning" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No slots added yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    @include('shared.footer')

    <div class="loadingPage">
        <div class="loader"></div>
    </div>
    <script src="{{ asset('assets/JS/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/JS/plugins/jQuery.js') }}"></script>
    <script src="{{ asset('assets/JS/global.js') }}"></script>
</body>

</html>
