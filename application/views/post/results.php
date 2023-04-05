
<script>
  var i = 1;
  var tbody = "";
 
 
  <?php foreach ($results as $result): ?>
    // Concatenate each row of data to the tbody variable
     $stringRole="";

    <?php $role = $result['type']; ?>

    <?php if($role == 0): ?>

      <?php $stringRole = "Admin"; ?>

    <?php else: ?>

      <?php $stringRole = "User"; ?>
      
    <?php endif; ?>
    

    tbody += "<tr>";
    tbody += "<td>" + "<?php echo $result['id']?>" + "</td>";
    tbody += "<td>" + "<?php echo $result['firstName']?>" + "</td>";
    tbody += "<td>" + "<?php echo $result['lastName']?>" + "</td>";
    tbody += "<td>" + "<?php echo $stringRole ?>"+ "</td>";
    tbody += `<td> 
    
      <a href="#" id="edit" class="btn btn-primary edit-button" value="<?php echo $result['id']; ?>">Edit</a>
      <a href="" id="" class="btn btn-danger delete-button" value="<?php echo $result['id']; ?>">Delete</a>
    </td>`;
    tbody += "</tr>";
  <?php endforeach; ?>

  // Set the tbody content to the generated HTML string
  $("#tbody").html(tbody);
</script>

