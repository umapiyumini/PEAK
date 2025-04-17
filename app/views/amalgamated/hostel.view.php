<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Hostel Requests</title>

    <style>
        /* styles.css */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f7fb;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }
/* 
        .sidebar {
            width: 250px;
            background-color: #eef2f7;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        } */

            /* .sidebar nav ul {
                list-style-type: none;
                width: 100%;
            }

            .sidebar nav ul li a {
                text-decoration: none;
                color: #333;
                display: block;
                padding: 10px;
                border-radius: 5px;
                font-weight: 500;
            }

            .sidebar nav ul li a.active,
            .sidebar nav ul li a:hover {
                background-color: #dde6f2;
            } */

        .new-request-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 220px;
            margin-top: 10px;
        }

        .main-content h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .inventory-table thead {
            background-color: #f4f4f4;
            font-weight: 600;
        }

        .inventory-table th,
        .inventory-table td {
            padding: 15px;
            text-align: left;
            color: #555;
        }

        .inventory-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            color: #fff;
        }

        .status.pending {
            background-color: #9370DB;
        }

        .status.approved {
            background-color: #4B0082;
        }

        .status.in-progress {
            background-color: #D8BFD8;
        }

        .status.declined {
            background-color: #800080;
        }

        h2 {
            font-size: 24px;
            margin: 20px;
        }

        .input-field {
            margin-bottom: 20px;
        }

        .input-field label {
            font-size: 16px;
            color: #555;
        }
        

        .input-field input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        /* ---------------BUTTON ------------ */
        /* Style for the button with class 'sendd' */
.sendd {
    background-color: #EEE6F3; /* Purple background */
    color: black;              /* Black text */
    border: 1px solid black; /* Purple border */
    border-radius: 8px;        /* Rounded corners */
    padding: 10px 20px;        /* Padding inside the button */
    font-size: 16px;           /* Font size */
    font-family: Arial, sans-serif; /* Font family */
    cursor: pointer;          /* Pointer cursor on hover */
    margin-top: 20px;          /* Top margin to separate from other elements */
    transition: all 0.3s ease; /* Smooth transition for hover effect */
}

/* Hover effect for button with class 'sendd' */
.sendd:hover {
    background-color: #6c3483; /* Dark purple on hover */
    color: white;               /* White text on hover */
}

/* Optional: Focus effect to make the button more accessible */
.sendd:focus {
    outline: none;             /* Remove the default focus outline */
    box-shadow: 0 0 0 2px #8e44ad; /* Custom purple focus outline */
}


    </style>
</head>
<body>

<?php include 'nav.view.php';?>

<main class="main-content">
    <h2>Badminton </h2>

    <table class="inventory-table">
        <thead>
            <tr>
                <th>Student Details (Registration No.)</th>
                <th>Priority (1-5)</th>
                <th>Starting Date</th>
                <th>End Date</th>
                <th>Hostel</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Amar (2022/IS/002)</td>
                <td>5</td>
                <td>Jan 1, 2024</td>
                <td>Jan 15, 2024</td>
                <td>
                <select id="venue">
        <option value="" class="j">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
    </select>
                
            </tr>
            <tr>
                <td>Teshawa (2022/CS/198)</td>
                <td>4</td>
                <td>Jan 10, 2024</td>
                <td>Jan 20, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Uma (2022/IS/021)</td>
                <td>3</td>
                <td>Jan 5, 2024</td>
                <td>Jan 15, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Sanudie (2022/IS/048)</td>
                <td>2</td>
                <td>Jan 12, 2024</td>
                <td>Jan 18, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Abdulla (2022/IS/001)</td>
                <td>4</td>
                <td>Jan 8, 2024</td>
                <td>Jan 22, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Hashir (2022/IS/003)</td>
                <td>1</td>
                <td>Jan 4, 2024</td>
                <td>Jan 14, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Nadeem (2022/IS/006)</td>
                <td>3</td>
                <td>Jan 3, 2024</td>
                <td>Jan 10, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
        </tbody>
    </table>    
    <button class="sendd">Send</button>

    <h2>Hockey </h2>

    <table class="inventory-table">
        <thead>
            <tr>
                <th>Student Details (Registration No.)</th>
                <th>Priority (1-5)</th>
                <th>Starting Date</th>
                <th>End Date</th>
                <th>Hostel</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Amantha (2022/CS/200)</td>
                <td>3</td>
                <td>Feb 5, 2024</td>
                <td>Feb 15, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Basith (2022/CS/134)</td>
                <td>4</td>
                <td>Feb 12, 2024</td>
                <td>Feb 20, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Murshid (2022/CS/034)</td>
                <td>2</td>
                <td>Feb 10, 2024</td>
                <td>Feb 18, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            <tr>
                <td>Hamdhi (2022/IS/032)</td>
                <td>5</td>
                <td>Feb 7, 2024</td>
                <td>Feb 17, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Sawani (2022/CS/121)</td>
                <td>1</td>
                <td>Feb 3, 2024</td>
                <td>Feb 10, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            </tr>
            <tr>
                <td>Raheem (2022/CS/012)</td>
                <td>4</td>
                <td>Feb 9, 2024</td>
                <td>Feb 19, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
            <tr>
                <td>John (2022/IS/09)</td>
                <td>3</td>
                <td>Feb 6, 2024</td>
                <td>Feb 16, 2024</td>
                <td>
                <select id="venue">
        <option value="">Select hostel</option>
        <option value="Ground">Kithyakara Mens Hostel</option>
        <option value="Indoor Stadium">Havelock Womens Hostel</option>
        <option value="Basket ball court">Bullers Womens Hostel</option>
        <option value="Tennis court">Bolomfontein Mens Hostel</option>
                </td>
                </tr>
                </tbody>
            </table>
            <button class="sendd">Send</button>
    </body>
    </html>
           
