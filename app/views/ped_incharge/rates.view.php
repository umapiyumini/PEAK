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
        <h3> Ground rates  </h3>

        <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search for court, event, duration, or price...">
        </div>


        <table>
            <thead>
                <tr>
                <th> Court </th>
                <th> Event </th>
                <th> Duration </th>
                <th> Description </th>
                <th> Price </th>
                <th> Edit </th>
                </tr>
            </thead>
            
            <tbody>
    <?php if (!empty($prices)): ?>
  <?php foreach ($prices as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row->court_name) ?></td>
      <td><?= htmlspecialchars($row->event) ?></td>
      <td><?= htmlspecialchars($row->duration) ?></td>
      <td><?= htmlspecialchars($row->description) ?></td>
      <td><?= number_format($row->price, 2) ?></td>
      <td>
        <!-- Example Edit Button/Link -->
        <button 
    class="edit-btn"
    onclick="openEditModal(
        '<?=htmlspecialchars($row->courtid, ENT_QUOTES)?>',
        '<?=htmlspecialchars($row->event, ENT_QUOTES)?>',
        '<?=htmlspecialchars($row->duration, ENT_QUOTES)?>',
        '<?=htmlspecialchars($row->description, ENT_QUOTES)?>',
        '<?=htmlspecialchars($row->price, ENT_QUOTES)?>'
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


    


</div>


 
  <!-- Edit Modal -->
<div id="editModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <form id="editForm" method="POST" action="<?=ROOT?>/ped_incharge/rates/update_ground_price">
      <input type="hidden" name="courtid" id="modal_courtid">
      <input type="hidden" name="event" id="modal_event">
      <input type="hidden" name="duration" id="modal_duration">
      <input type="hidden" name="description" id="modal_description">
      <label for="modal_price">Price:</label>
      <input type="number" step="0.01" name="price" id="modal_price" required>
      <button type="submit">Save</button>
    </form>
  </div>
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
function openEditModal(courtid, event, duration, description, price) {
    document.getElementById('modal_courtid').value = courtid;
    document.getElementById('modal_event').value = event;
    document.getElementById('modal_duration').value = duration;
    document.getElementById('modal_description').value = description;
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
