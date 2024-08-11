<!DOCTYPE html>
<html>
<head>
    <title>Salary Slip - {{ $employee->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Salary Slip</h2>
                            </td>
                            <td>
                                <strong>Date:</strong> {{ now()->format('d-m-Y') }}<br>
                                <strong>Month:</strong> {{ $request->month }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                <strong>Employee Name:</strong> {{ $employee->name }}<br>
                                <strong>Employee ID:</strong> {{ $employee->id }}
                            </td>
                            <td>
                                <strong>Address</strong>
                                {{ $employee->address}}<br>
                                 <strong>Phpne</strong>
                                {{ $employee->phone}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Description</td>
                <td>Amount</td>
            </tr>
            <tr class="item">
                <td>Base Salary</td>
                <td>${{ number_format($employee->salary, 2) }}</td>
            </tr>
            <tr class="item">
                <td>Attendance Bonus</td>
                <td>${{ number_format($totalSalary - $employee->salary, 2) }}</td>
            </tr>
            <tr class="item last">
                <td>Total Working Days</td>
                <td>{{ $request->total_working_days }} days</td>
            </tr>
            <tr class="item last">
                <td>Attending Working Days</td>
                <td>{{ $request->attending_days }} days</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>Total: ${{ number_format($totalSalary, 2) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
