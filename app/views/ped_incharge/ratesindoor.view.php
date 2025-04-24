<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/rates.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<?php $current_page = 'facilities'; include 'sidebar.view.php';?>
<div class="main-content">
        <h3> Indoor Rates  </h3>

        <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search for court, event, duration, or price...">
        </div>


       
<table>
    <thead>
        <tr>
        <th> Court </th>
        <th> Event </th>
        <th> Duration </th>
      
        <th> Price </th>
        <th> Edit </th>
        </tr>
    </thead>
    
    <tbody>
<?php if (!empty($rates)): ?>
<?php foreach ($rates as $rate): ?>
<tr>
<td><?= htmlspecialchars($rate->court_name) ?></td>
<td><?= htmlspecialchars($rate->event) ?></td>
<td><?= htmlspecialchars($rate->duration) ?></td>
<td><?= number_format($rate->price, 2) ?></td>
<td>
<!-- Example Edit Button/Link -->
<button 
    class="edit-btn"
    onclick="openEditModal(
        '<?=htmlspecialchars($rate->courtid, ENT_QUOTES)?>',
        '<?=htmlspecialchars($rate->event, ENT_QUOTES)?>',
        '<?=htmlspecialchars($rate->duration, ENT_QUOTES)?>',
        '<?=htmlspecialchars($rate->price, ENT_QUOTES)?>'
    )"
    type="button">Edit</button>

</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<!-- <tr>
<td colspan="5">No data available.</td>
</tr> -->
<?php endif; ?>


</tbody>
</table>



<!-- Edit Modal -->
<div id="editModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <form id="editForm" method="POST" action="<?=ROOT?>/ped_incharge/ratesindoor/update_ground_price">
      <input type="hidden" name="courtid" id="modal_courtid">
      <input type="hidden" name="event" id="modal_event">
      <input type="hidden" name="duration" id="modal_duration">
      <label for="modal_price">Price:</label>
      <input type="number" step="0.01" name="price" id="modal_price" required>
      <button type="submit">Save</button>
    </form>
  </div>
</div>
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var table = document.querySelector('table');
    var trs = table.getElementsByTagName('tr');
    // Start from 1 to skip the header row
    for (var i = 1; i < trs.length; i++) {
        var tds = trs[i].getElementsByTagName('td');
        var rowContainsFilter = false;
        for (var j = 0; j < tds.length; j++) {
            if (tds[j].textContent.toLowerCase().indexOf(filter) > -1) {
                rowContainsFilter = true;
                break;
            }
        }
        trs[i].style.display = rowContainsFilter ? '' : 'none';
    }
});



// for the edit modal
function openEditModal(courtid, event, duration,  price) {
    document.getElementById('modal_courtid').value = courtid;
    document.getElementById('modal_event').value = event;
    document.getElementById('modal_duration').value = duration;
    document.getElementById('modal_price').value = price;
    document.getElementById('editModal').style.display = 'block';
}
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
window.onclick = function(event) {
    var modal = document.getElementById('editModal');
    if (event.target == modal) modal.style.display = "none";
}
</script>

</body>
</html>