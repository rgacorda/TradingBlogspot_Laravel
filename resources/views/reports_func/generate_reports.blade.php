<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Reports</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
        }

        .container {
            max-width: 1200px;
        }

        .pull-right {
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Reports</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->first_name }} {{ $post->middle_name }} {{ $post->last_name }}</td>
                        <td>{{ $post->cat_desc }}</td>
                        <td>
                            @if ($post->isApproved === 'Accepted')
                                <span class="badge bg-success">Approved</span>
                            @elseif ($post->isApproved === 'Rejected')
                                <span class="badge bg-danger">Declined</span>
                            @else
                                <span class="badge bg-warning">To be Approved</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->toFormattedDateString() }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist
