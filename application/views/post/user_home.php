<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="<?php echo base_url()?>\assets\css\home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  </head>
  <body>
  <Header>
  <?php $this->load->view('/post/user_header'); ?>
  </Header>
  <div class="container text-center">
  <div class="row align-items-start">
 
    <div class="col">
        <table class="table">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Role</th>
         
          
          
        </tr>
      </thead>
      <tbody id="tbody">

    

      </tbody>
    </table>
    </div>
  </div>
 
</div>
  

     

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="<?php echo base_url("/assets/js/jquery-3.6.4.min.js")?>"></script>

<script>
   function fetch() {
        $.ajax({
            url: "<?php echo base_url(); ?>fetch",
            type: "get",
            dataType: "json",
            success: function(data) {
                var i = 1;
                var tbody = "";
                for (var key in data) {

                  if(data[key]['type']==0){
                      role = "Admin";
                    }
                    else{
                      role = "User";
                    }
                    tbody += "<tr>";
                    // tbody += "<td>" + i++ + "</td>";
                    tbody += "<td>" + data[key]['id'] + "</td>";
                    tbody += "<td>" + data[key]['firstName'] + "</td>";
                    tbody += "<td>" + data[key]['lastName'] + "</td>";
                    tbody += "<td>" + role + "</td>";
                    
                   
                    tbody += "<tr>";
                }
                   

                $("#tbody").html(tbody);
            }
        });
    }

   fetch();

  
  
  
</script>
<div id="search-results"> </div>
    <script>
          $(document).ready(function() {
          $('#search-form').submit(function(e) {
          e.preventDefault(); // prevent the form from submitting in the traditional way
          var searchTerm = $('input[name="search-term"]').val();
            $.ajax({
              url: 'user_search',
              type: 'POST',
              data: {searchTerm: searchTerm},
              success: function(data) {
                $('#search-results').html(data); // display the search results
              }
            });
      });
    });

    </script>
   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>