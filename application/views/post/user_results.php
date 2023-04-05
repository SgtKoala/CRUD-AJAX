
<script>
  var i = 1;
  var tbody = "";
  var role ="";
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
    tbody += "<td>" + "<?php echo $stringRole?>" + "</td>";
    
    tbody += "</tr>";
  <?php endforeach; ?>

  // Set the tbody content to the generated HTML string
  $("#tbody").html(tbody);
</script>

