<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title??"Laporan"}}</title>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">

</head>

<body>
    <div class="header-container">
        <div class="header-information">
            <div class="header-title">
                <h2>Management</h2>
            </div>
            <div class="header-description">
                <p><small>Title : List of {{$company}} (ID {{$company_id}}) Company's Employees</small></p>
                <p>
                    <small>Created at : {{$report_created_at}} GMT+0</small>
                </p>
            </div>
        </div>
    </div>
    <hr />
    <div class="content-container">
        <section class="filter-information-container" title="Reports">

            @if(count($report_data)>0)

            {{-- <h4>2. Isi Laporan </h4> --}}
            <table class="filter-joined-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                @foreach ($report_data as $key => $report)

                <tr>
                    <td class="text-center">{{$report->id}}</td>
                    <td class="text-center">
                        {{$report->name}}
                    </td>
                    <td class="text-center">{{$report->email}}</td>


                </tr>
                @endforeach
            </table>
            @else
            <p>There are no employees listed here.</p>
            @endif


        </section>
    </div>
</body>

</html>
