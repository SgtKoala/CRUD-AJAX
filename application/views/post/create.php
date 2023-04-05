<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Post</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\css\create.css">
</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Register</h2>
      </div>

      <div class="col-lg-12">

        <div class="d-flex justify-content-center ">
         
        <form id="create-form">
          
          <div class="form-group">
            <label for="titleID">Username</label>
            <input class="form-control" type="text" name="username" id="userID">
          </div>
          <div class="form-group">
            <label for="titleID">Password</label>
            <input class="form-control" type="password" name="password" id="passID">
          </div>
  
          <div class="form-group">
            <label for="titleID">First Name</label>
            <input class="form-control" type="text" name="firstname" id="firstID">
          </div>

          <div class="form-group">
            <label for="descriptionID">Last name</label>
            <input class="form-control" type="text" name="lastname" id="lastID">
          </div>

          <div class="form-group">
            <label for="descriptionID">Role</label>
            <input class="form-control" type="number" name="role" id="roleID" placeholder="0 = Admin 1 = User" Required>
          </div>

          

      </div>

      <div class="d-flex justify-content-center " id="submit-button">
        <div class="form-group">
              

                <button type="submit" class="btn btn-success" id="buttonCreate"> <i class="fas fa-check"></i> Submit </button>
                
                
        </div>
       </form>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src="<?php echo base_url("/assets/js/jquery-3.6.4.min.js")?>"></script>
  <script>
    $(document).ready(function(){
        $('#create-form').submit(function(event){
            event.preventDefault();
            
            $.ajax({
                url:'<?php echo base_url('TestController/store')?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                  if (response === 'success'){
                    alert('Record created Successfully');
                    window.location.href = '<?php echo base_url('login') ?>';
                    
                  }else{
                    alert('Failed');
                  }
                }

            });
        });
    });
  </script>
</body>

</html>