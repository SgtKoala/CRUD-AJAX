<?php foreach ($results as $result): ?>
    <h3><?= $result['id'] ?></h3>
  <h3><?= $result['firstName'] ?></h3>
  <p><?= $result['username'] ?></p>
  <p><?= $result['lastName'] ?></p>
<?php endforeach; ?>