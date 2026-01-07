<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Short URLs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #2563eb;
            color: #fff;
        }

        tr:hover {
            background: #f1f5f9;
        }

        .empty {
            padding: 20px;
            background: #fff;
            text-align: center;
            color: #555;
        }

        .badge {
            padding: 4px 8px;
            background: #e5e7eb;
            border-radius: 4px;
            font-size: 12px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="top-bar">
        <h2>Short URLs List</h2>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    {{-- Role info --}}
    <p>
        Logged in as:
        <strong>{{ auth()->user()->name }}</strong>
        (<span class="badge">{{ auth()->user()->role->name }}</span>)
    </p>

    {{-- Empty state --}}
    @if ($urls->count() === 0)
        <div class="empty">
            No short URLs available for you.
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Short Code</th>
                    <th>Original URL</th>
                    <th>Created By</th>
                    <th>Company</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($urls as $index => $url)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $url->code }}</td>
                        <td>
                            <a href="{{ $url->original_url }}" target="_blank">
                                {{ $url->original_url }}
                            </a>
                        </td>
                        {{-- <td>{{ $url->user->name }}</td> --}}
                        <td>{{ optional($url->user)->name }}</td>

                        <td>{{ $url->user->company->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
