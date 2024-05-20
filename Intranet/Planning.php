<?php require('include/entete.inc.php');?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Planning</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Heure</th>
            <th>Lundi</th>
            <th>Mardi</th>
            <th>Mercredi</th>
            <th>Jeudi</th>
            <th>Vendredi</th>
            <th>Samedi</th>
            <th>Dimanche</th>
          </tr>
        </thead>
        <tbody>
          <?php for ($h = 6; $h <= 21; $h++) { ?>
            <tr>
              <td><?php echo $h . "h"; ?></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
              <td contenteditable="true" class="day"></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <script>
      $(document).ready(function() {
        $(".day").on("blur", function() {
          localStorage.setItem($(this).closest("tr").index(), $(this).html());
        });
        $("td.day").each(function() {
          $(this).html(localStorage.getItem($(this).closest("tr").index()));
        });
      });
    </script>
  </body>
</html>


<?php require('include/pied.inc.php');?>