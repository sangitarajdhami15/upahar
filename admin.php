<?php
include("adminheader.php");
?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Total Products</h1>
        
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
            <th>SN</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Farmer Name </th>
                    <th>Contact </th>
                    <th>Quantity Type</th>
                    <th>Quantity</th>
                    <th>Quality</th>
                    <th>Unit Price</th>
                    <th>Base Price</th>
                    <th>Status</th>
                    <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
                
                $conn=new mysqli("localhost","root","","agtrade");
                if($conn->connect_error)
                {
                    die("Connection Error");
                }
                $sql="SELECT * FROM product";
                $result=$conn->query($sql);
                $i=1;
                
                foreach($result as $row)
                {
                    echo"<tr>";
                    echo("<td>".$i++."</td><td>".$row['product_name']."</td><td>".$row['product_description']."</td><td>".$row['farmer_name']."</td><td>".$row['phoneno']."</td>");
                    echo("<td>".$row['product_quantitytype']."</td><td>".$row['product_quantity']."</td><td>".$row['product_category']."</td>");
                    echo("<td>".$row['product_unitprice']."</td><td>".$row['product_minimumbid']."</td><td>".$row['product_status']."</td>");
                    if($row['verification']=='Yes')
                    {
                    }
                    else{
                    echo "
                    
                    <td>
                    <button id='".$row['product_id']."'class='btnUpdate btn btn-outline-success'>Verify</button>
                    </td>  
                                
                    </tr>
                    
                    ";
                    }
                    
                   }
                
                ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script>
        $(document).ready(function(){

            /*Product bid Accept code Update Started*/
            $('.btnUpdate').click(function(){
                var product_id=this.id;
                $.ajax({
                    url: "phpFiles/adminproducts.php", 
                    type:'POST',
                    data:{product_id:product_id},
                    success: function(result){
                       var jData=JSON.parse(result);
                       $('#product_name').val(jData[0].product_name);
                       $('#name').val(jData[0].farmer_name);
                       $('#product_description').val(jData[0].product_description);
                       $('#product_quantitytype').val(jData[0].product_quantitytype);
                       $('#product_quantity').val(jData[0].product_quantity);
                       $('#product_unitprice').val(jData[0].product_unitprice);
                       $('#product_minimumbid').val(jData[0].product_minimumbid);
                       $('#hidden_id').val(product_id);
                       $("#updatemdl").modal("show");
                    }
                    });
                
                
            });

            $('#updateBid').click(function(e){
                e.preventDefault();
                var product_id=$('#hidden_id').val();
                
                
                
                $.ajax({
                    url: "phpFiles/updateverify.php", 
                    type:'POST',
                    data:{product_id:product_id,},
                    success: function(result){
                        alert(result);
                        location.reload();
                    }
                    });
            });
        });
        
</script> 
</body>
</html>
<!-- Modal for Udating Book Starts-->
<div class="modal fade" tabindex="-1" id="updatemdl">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-body ">
                    <form  method="post">  
                         
                    <form action="adminproducts" method="post">
               
                    <div class="form-group">
                        <label>
                            Product Name
                        </label>
                        <input type="text" class="form-control" placeholder="Enter  Product Name" id="product_name" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>
                            Product Description
                        </label>
                        <input type="text" class="form-control" placeholder="Product Desription" id="product_description" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>
                            Name of Farmer
                        </label>
                        <input type="text" class="form-control" placeholder="Farmer Name" id="name" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>Quantity Type</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="product_quantitytype" id="product_quantitytype" readonly>
                            <option value="kg">KG</option>
                            <option value="gram">GRAM</option>
                            <option value="litre">Litre</option>
                            <option value="packet">Packet</option>
                            <option value="Bora">Bora</option>
                            <option value="caret">CARET</option>
                            <option value="pieces">Pieces</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" placeholder="Enter Quantity" id="product_quantity" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>Unit Price</label>
                        <input type="number" class="form-control" placeholder="Enter Unit Price" id="product_unitprice"
                            autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="product_category" id="product_category" readonly>
                            <option value="High">High</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Minimum Bid Amount(Rs)</label>
                        <input type="number" class="form-control" placeholder="Enter Base Price" id="product_minimumbid" autocomplete="off" readonly>
                    </div>
                    <br> 
                    <!-- product ko id product_id-->
                    <input type="hidden" name="hidden_id" id="hidden_id">
                    <button type="submit" class="btn btn-success" id="updateBid">Verified</button>
                    <button type="submit" class="btn btn-secondary" id="cancel">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>