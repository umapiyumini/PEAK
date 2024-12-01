<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Table</title>
    <link rel="stylesheet" href="requests_table.css">
</head>
<body>

<div class="table-container">
    <table>
        <thead>
            <tr>
            <th><input type="checkbox"></th>
                <th>Request Number</th>
                <th>Creation Date</th>
                <th>Date</th>
                <th>Time</th>
                <th>Event</th>
                <th>Client</th>
                <th>Client's Phone</th>
                <th>Payment amount</th>
                <th>Payment status</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="checkbox"></td>
                <td>No 205176503</td>
                <td>30 April, 2020</td>
                <td>25 May, 2020</td>
                <td>3pm-6pm</td>
                <td>hockey match</td>
                <td>Brian Pierce</td>
                <td>(837) 877-4746</td>
                <td>$222.61</td>
                <td class="payment-status paid">Paid</td>
                <td><span class="dot new"></span>New</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>No 205176503</td>
                <td>30 April, 2020</td>
                <td>25 May, 2020</td>
                <td>3pm-6pm</td>
                <td>hockey match</td>
                <td>Brian Pierce</td>
                <td>(837) 877-4746</td>
                <td>$222.61</td>
                <td class="payment-status not_paid">Not Paid</td>
                <td><span class="dot in-progress"></span>In Progress</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>No 205176503</td>
                <td>30 April, 2020</td>
                <td>25 May, 2020</td>
                <td>3pm-6pm</td>
                <td>hockey match</td>
                <td>Brian Pierce</td>
                <td>(837) 877-4746</td>
                <td>$222.61</td>
                <td class="payment-status paid">Paid</td>
                <td><span class="dot awaiting"></span>Awaiting</td>
            </tr>

            <tr>
                <td><input type="checkbox"></td>
                <td>No 205176503</td>
                <td>30 April, 2020</td>
                <td>25 May, 2020</td>
                <td>3pm-6pm</td>
                <td>hockey match</td>
                <td>Brian Pierce</td>
                <td>(837) 877-4746</td>
                <td>$222.61</td>
                <td class="payment-status not_paid">Not paid</td>
                <td class=><span class="dot cancelled"></span>Cancelled</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

</body>
</html>
