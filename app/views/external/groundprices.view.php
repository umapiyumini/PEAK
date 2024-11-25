<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/uma/groundprices.css">
        <title>External User Dashboard</title>
    </head>


    <body>
        <!-- navigation bar -->
        <?php include 'enav.view.php'; ?>
        <div class="main">
        <?php include 'top.view.php'; ?>
        <div class="container1">
                <h1 class="title1">Rates for Hiring of UOC Ground</h1>
            
                <!-- Search Bar -->
                <div class="search-container">
                  <input
                    type="text"
                    id="search-bar"
                    placeholder="Search for a facility..."
                    onkeyup="searchFacility()"
                  />
                </div>
            
                <!-- Rates Table -->
                <table class="rates-table" id="rates-table">
                  <thead>
                    <tr>
                      <th>Ground</th>
                      <th colspan="3">Practice (with Supervisor Charges)</th>
                      <th colspan="3">Matches / Sports Festivals (with Supervisor Charges)</th>
                    </tr>
                    <tr>
                      <th></th>
                      <th>Full Day (Rs.)</th>
                      <th>Half Day (Rs.)</th>
                      <th>Two Hours (Rs.)</th>
                      <th>Full Day (Rs.)</th>
                      <th>Half Day (Rs.)</th>
                      <th>Two Hours (Rs.)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Baseball (30 Persons for practices)</td>
                      <td>30,000.00</td>
                      <td>17,500.00</td>
                      <td>-</td>
                      <td>65,000.00</td>
                      <td>35,000.00</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td>Basketball (25 Persons for practices) (without light)</td>
                      <td>20,000.00</td>
                      <td>12,000.00</td>
                      <td>6,000.00</td>
                      <td>40,000.00</td>
                      <td>25,000.00</td>
                      <td>10,000.00</td>
                    </tr>
                    <tr>
                      <td>Basketball (25 Persons for practices) (with light)</td>
                      <td>-</td>
                      <td>17,500.00</td>
                      <td>8,000.00</td>
                      <td>-</td>
                      <td>25,000.00</td>
                      <td>12,500.00</td>
                    </tr>
                    <tr>
                      <td>Cricket - Hard Ball with matting</td>
                      <td>30,000.00</td>
                      <td>17,500.00</td>
                      <td>10,000.00</td>
                      <td>35,000.00</td>
                      <td>20,000.00</td>
                      <td>-</td>
                    </tr>
                    <tr>
                      <td>Soft Ball Cricket & Other functions (max. 3 pitches)</td>
                      <td>-</td>
                      <td>-</td>
                      <td>
                        4,000.00 (During working hours) <br>
                        4,600.00 (Other than working hours)
                      </td>
                      <td>115,000.00</td>
                      <td>65,000.00</td>
                      <td>
                        10,000.00 (During working hours) <br>
                        13,000.00 (Other than working hours)
                      </td>
                    </tr>
                  </tbody>
                </table>
             
            
              
            

              </div>
            </div>
           
            </body>
            </html>