<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-1.0">
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/vidusha/todo.css">
        <title>Staff Dashboard</title>
    </head>


    <body>

        <div class="container">
        <div class="todo-list">
            <h2>To-Do List</h2>
            <div id="toDoListContainer">
  
    <div id="taskFilter">
        <label for="taskFilterSelect">Filter Tasks:</label>
        <select id="taskFilterSelect">
            <option value="all">All Tasks</option>
            <option value="completed">Completed</option>
            <option value="notCompleted">Not Completed</option>
        </select>
    </div>

    <div class="table-wrapper">
        <table id="taskTable">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Complete</th>
                    <!--th>Remarks</th-->
                </tr>
            </thead>
            <tbody>
                
                <?php if(!empty($task)): ?>
                    <?php foreach($task as $item): ?>
                    <tr>
                    <td><?=htmlspecialchars($item->taskname)?></td>
                    <td><?=htmlspecialchars($item->description)?></td>
                    <td><?=htmlspecialchars($item->deadline)?></td>
                    <td><input type="checkbox" class="status-checkbox"
                        data-task-id="<?= $item->taskid ?>"
                        <?= $item->status === 'Completed' ? 'checked' : '' ?>>
                    </td>
                    <!--td><?=htmlspecialchars($item->remark)?></td-->
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                    <td colspan="4">No data available</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
        </div>

    <script>const ROOT = "<?=ROOT?>";</script>

    <script src="<?=ROOT?>/assets/js/vidusha/todo.js"></script>

    
    
</body>
</html>

