<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Post</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets\css\login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="assets\css\create.css"> -->
</head>

<body>

  <div class="container">
    <div class="row">

      <div class="col-lg-12 my-5">
        <h2 class="text-center mb-3">Login</h2>
      </div>

      <div class="col-lg-12">

        <div class="d-flex justify-content-center ">
         
		<form method="POST" action="<?php echo base_url(); ?>index.php/testcontroller/login">
        <input type="hidden" id="role" value="">
        <input type="hidden" id="new_id" value="">
          
          <div class="form-group">
            <label for="titleID">Username</label>
            <input class="form-control" type="text" name="username" id="userID">
            
          </div>
          <div class="form-group">
            <label for="titleID">Password</label>
            <input class="form-control" type="password" name="password" id="passID">
          </div>
  
          

      </div>

      <div class="d-flex justify-content-center " id="button-login">
        <div class="form-group submitButton" >
                <button type="submit" class="btn btn-success" id="buttonLogin"> <i class="fas fa-check"></i> Submit </button>
          
        </div>
       
       </form>
	  
	   </div>
      </div>

	 
      <div class="d-flex justify-content-center " id="register-link">
        <div class="form-group" >
        <a href="create">Register here</a>
          
        </div>
       
      
      </div>
	  <div class="container">
	   <?php
				if($this->session->flashdata('error')){
					?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php
				}
			?>
	   </div>
    
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
 
  <script>

  

  </script>

</body>
</html>