<!--
  TODO:
  Incorporate the original Task table made by Derek here since we need the admin
  to be able to visit a Task's page to edit it, etc.
-->
<table class="table table-striped">
  <thead>
    <tr>
      <td>id</td>
      <td>Title</td>
      <td>Description</td>
      <td>Creator Name</td>
      <td>Doer Name</td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>12345</td>
      <td><?php echo $tasktitle?></td>
      <td>description of some sort</td>
      <td><?php echo $taskcreator?></td>
      <td><?php echo $taskdoer?></td>
    </tr>
  </tbody>
</table>
