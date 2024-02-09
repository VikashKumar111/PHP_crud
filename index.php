<?php 
  require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Details</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
  </head>
  <body class="bg-light">
    <div class="container bg-dark text-light p-3 rounded my-4">
      <div class="d-flex align-items-center justify-content-between px-3">
        <h2>
          <a href="index.php" class="text-white text-decoration-none"
            ><i class="bi bi-person-standing"></i>Student Details</a
          >
        </h2>

        <button
          type="button"
          class="btn btn-success"
          data-bs-toggle="modal"
          data-bs-target="#addstudent"
        >
          <i class="bi bi-plus-lg"></i> Add Students
        </button>
      </div>
    </div>

    <div class="container mt-5 p-0">
      <table class="table table-hover text-center">
        <thead class="bg-dark text-light">
          <tr>
            <th scope="col" width="12%" class="rounded-start">Sr. No.</th>
            <th scope="col" width="12%">Name</th>
            <th scope="col" width="12%">Roll Number</th>
            <th scope="col" width="20%">Image</th>
            <th scope="col" width="12%">Marks</th>
            <th scope="col" width="12%">Branch</th>
            <th scope="col" width="20%" class="rounded-end">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">

           <?php
             $query="SELECT * FROM `details`";
             $result=mysqli_query($con,$query); 
             $i=1;
             $fetch_src=FETCH_SRC;
            
            while($fetch=mysqli_fetch_assoc($result)) 
            { 
              echo<<<student
                  <tr class="align-middle">
                    <th scope="row">$i</th>
                    <td>$fetch[name]</td>
                    <td>$fetch[rollnumber]</td>
                    <td><img src="$fetch_src$fetch[image]" width="150px" height="100px" /></td>
                    <td>$fetch[marks]</td>
                    <td>$fetch[branch]</td>
                    <td>
                     <a href="?edit=$fetch[id]" class="btn btn-warning me-3"><i class="bi bi-pencil-square"></i></a>
                     <button onclick="confirm_rem($fetch[id])" class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                    </td>
                  </tr>
              student; 
              $i++;
            } 
    ?>
         
        </tbody>
      </table>
    </div>

    <div
      class="modal fade"
      id="addstudent"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form action="crud.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Student</h5>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                <span class="input-group-text">Name</span>
                <input type="text" class="form-control" name="name" required />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Roll Number</span>
                <input
                  type="text"
                  class="form-control"
                  name="rollnumber"
                  required
                />
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text">Image</label>
                <input
                  type="file"
                  class="form-control"
                  name="image"
                  accept=".jpg, .png, .svg"
                  required
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Mraks</span>
                <input type="text" class="form-control" name="marks" required />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Branch</span>
                <input
                  type="text"
                  class="form-control"
                  name="branch"
                  required
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn btn-outline-secondary"
                data-bs-dismiss="modal"
              >
                Cancel
              </button>
              <button type="submit" class="btn btn-success" name="addstudent">
                Add
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div
      class="modal fade"
      id="editstudent"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form action="crud.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Student</h5>
            </div>
            <div class="modal-body">
              <div class="input-group mb-3">
                <span class="input-group-text">Name</span>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id="editname"
                  required
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Roll Number</span>
                <input
                  type="text"
                  class="form-control"
                  name="rollnumber"
                  id="editrollnumber"
                  required
                />
              </div>
              <img src="" id="editimg" width="100%" class="mb-3" /> <br />
              <div class="input-group mb-3">
                <label class="input-group-text">Image</label>
                <input
                  type="file"
                  class="form-control"
                  name="image"
                  accept=".jpg, .png, .svg"
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Mraks</span>
                <input
                  type="text"
                  class="form-control"
                  name="marks"
                  id="editmarks"
                  required
                />
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Branch</span>
                <input
                  type="text"
                  class="form-control"
                  name="branch"
                  id="editbranch"
                  required
                />
              </div>

              <input
                  type="hidden"
                  name="editpid"
                  id="editpid"
                />
            </div>
            <div class="modal-footer">
              <button
                type="reset"
                class="btn btn-outline-secondary"
                data-bs-dismiss="modal"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="btn btn-success"
                name="editstudent"
                id="editstudent"
              >
                Edit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
     <?php
            
            if(isset($_GET['edit']) && $_GET['edit']>0) 
            { 
              $query="SELECT * FROM `details` WHERE `id`='$_GET[edit]'";
              $result=mysqli_query($con,$query); 
              $fetch=mysqli_fetch_assoc($result);
              echo"
                  <script>
                       var editstudent = new bootstrap.Modal(document.getElementById('editstudent'),{
                       keyboard: false
                       });
                       document.querySelector('#editname').value=`$fetch[name]`;
                       document.querySelector('#editrollnumber').value=`$fetch[rollnumber]`;
                       document.querySelector('#editimg').src=`$fetch_src$fetch[image]`;
                       document.querySelector('#editmarks').value=`$fetch[marks]`;
                       document.querySelector('#editbranch').value=`$fetch[branch]`;
                       document.querySelector('#editpid').value=`$_GET[edit]`;
                       editstudent.show();
                  </script>
              "; 
            } 
    ?> 

     
   
    <script>
      function confirm_rem(id) {
        if (confirm("Are you sure, you want to delete this item ?")) {
          window.location.href = "crud.php?rem=" + id;
        }
      }
    </script>
  </body>
</html>
