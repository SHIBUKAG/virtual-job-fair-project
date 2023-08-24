<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 15px;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
    }

    </style>
</head>
<body>
    <div class="container">
        <h1>Posted Jobs</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($postedJobs as $job)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->job_title }}</h5>
                        <p class="card-text">{{ $job->job_description }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="card-text"><strong>Salary:</strong> {{ $job->updated_at }}</p>
                        <a href="{{ $job->id }}" class="btn btn-primary">Manage</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>


{{-- {{ route('edit_job', $job->id) }}" --}}