
<script>
  var i = 1;
  var tbody = "";
  var role ="";
  <?php foreach ($results as $result): ?>
    // Concatenate each row of data to the tbody variable
    tbody += "<tr>";
    tbody += "<td>" + "<?php echo $result['id']?>" + "</td>";
    tbody += "<td>" + "<?php echo $result['firstName']?>" + "</td>";
    tbody += "<td>" + "<?php echo $result['lastName']?>" + "</td>";
    tbody += "<td>" + "<?php echo $result['type']?>" + "</td>";
    
    tbody += "</tr>";
  <?php endforeach; ?>

  // Set the tbody content to the generated HTML string
  $("#tbody").html(tbody);
</script>

