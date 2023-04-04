<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="assets\css\home.css">
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
  <!-- <a href="<?php echo base_url(); ?>/testcontroller/logout" class="btn btn-danger">Logout</a> -->
</div>
  

     
  



<!-- Modal -->

  <!-- <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
        <form id="update-form" action ="" method="post">
          <input type="hidden" id="edit_modal_id" value="">

        <div class="form-group">
          <label for="titleID">Name</label>
          <input class="form-control" type="text" name="firstname" id="edit_first">
        </div>

        <div class="form-group">
          <label for="descriptionID">Last Name</label>
          <input class="form-control" type="text" name="lastname" id="edit_last">
        </div>

        <div class="form-group">
          <label for="descriptionID">Role</label>
          <input class="form-control" type="number" name="role" id="edit_role" placeholder="0 = Admin 1 = User" Required>
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary" id="updateID">Update</button>
        </form>

  </div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div> -->

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
                    tbody += "<tr>";
                    // tbody += "<td>" + i++ + "</td>";
                    tbody += "<td>" + data[key]['id'] + "</td>";
                    tbody += "<td>" + data[key]['firstName'] + "</td>";
                    tbody += "<td>" + data[key]['lastName'] + "</td>";
                    tbody += "<td>" + data[key]['type'] + "</td>";
                   
                    tbody += "<tr>";
                }
                   

                $("#tbody").html(tbody);
            }
        });
    }

   fetch();

  
  $(document).on("click", "#edit", function(event){
  

    event.preventDefault();
    // var button = $(event.relatedTarget);
    // var row = $(this).closest('tr');
    // var id = row.data('id');
    var edit_id = $(this).attr("value");

    // console.log(id);
    console.log(edit_id);
    
    if(edit_id ==""){
      console.log("empty id");
    }
    else{
     
      $.ajax({
        url:"<?php echo base_url(); ?>edit",
        type:"post",
        dataType: "json",
        data: {
            edit_id: edit_id
        },
        
        success: function(data){

  
         if (data.response ==='success'){
          
          $('#exampleModal').modal('show');
          $("#edit_modal_id").val(data.post.id);
          $('#edit_first').val(data.post.firstName);
          $('#edit_last').val(data.post.lastName);
          $('#edit_role').val(data.post.type);
          console.log(data);

         }else{
            console.log("error");
         }
        }
       
       
      });
     
    }
  });

    



    $(document).on("click","#updateID",function(e){
      e.preventDefault();

    //  var row = $(this).closest('tr');
    //  var id = row.data('id');
     var edit_id = $("#edit_modal_id").val();
     var edit_first = $("#edit_first").val();
     var edit_last = $("#edit_last").val();
     var edit_role = $("#edit_role").val();

     if(edit_id == "" || edit_first== "" || edit_last == "" ||edit_role =="" ){
      alert("required " +edit_id +" "+edit_first+" "+edit_last+ " "+edit_role);

     }else{
      console.log("data: " +edit_id +" "+edit_first+" "+edit_last+ " "+edit_role);
      
      $.ajax({
        url: "<?php echo base_url(); ?>update",
        type:"post",
        dataType:"json",
        data: {
          edit_id: edit_id,
          edit_first: edit_first,
          edit_last: edit_last,
          edit_role: edit_role

        },
        success: function(data){
         
          fetch();
          if(data.response ==='success'){
            $('#exampleModal').modal('hide');
          }else{
            
            console.log(data);
            console.log("error below");

            console.log(data.response);
          }
          
        }
      });
     }
    });
    fetch();
    $("#update-form")[0].reset();
</script>


<script>
  $(document).ready(function(){
    
    // $('#delete-button').on('click', function(){

    // })
    // $('.delete-button').click(function(event){
      $(document).on("click", ".delete-button", function(e) {
      event.preventDefault();
      // var row = $(this).closest('tr');
      // var id = row.data('id');
      var del_id = $(this).attr("value");
      if(del_id ==""){
        console.log("id empty");
      }
      else{
        console.log(del_id);
      
      $.ajax({
        url:'<?php echo base_url('TestController/delete/')?>'+ del_id,
        type:'post',
        dataType:"json",
        data:{
          del_id: del_id
        },
        success: function(data){
          fetch();
          if(data.response === 'success'){
            // row.remove();
            alert('Record deleted successfully');
          }else{
            alert('Failed to delete');
          } 
        }
        
      });
    }
    });
  });
  
</script>
   
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  </body>
</html>