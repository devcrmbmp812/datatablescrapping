<!DOCTYPE html>
<html>
<head>
  <title>Publisher Form</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"  >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  >
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"  >
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css"  >
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css"  >
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
  <script src="https://code.jquery.com/jquery-3.3.1.js"  ></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"  ></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"  ></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"  ></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"  ></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
</head>
<body>
    <?php
    error_reporting(1);
    error_reporting(E_ALL);
ini_set('max_execution_time', 0);
ini_set('memory_limit','160M'); 
@ini_set( 'upload_max_size' , '25MB' );
@ini_set( 'post_max_size', '27MB');


$publishers=array("Cengage","Brooks/Cole","Course Technology","Cengage Learning","Delmar","Heinle","Schirmer","South-Western","Wadsworth");
// $publishers=array("Pearson");

$publisherDATA=array();
 $restKey = '40404_d3d20e85cbd88282e6e49193cfdc7130';  
  $headers = array(  
 "Content-Type: application/json",  
   "Authorization: " . $restKey 
 );  
 
foreach($publishers as $pubdata){
for($i=1; $i<3; $i++){
        $url = 'https://api2.isbndb.com/books/'.$pubdata.'?page='.$i.'&pageSize=1000';  

 

 $rest = curl_init();  
 curl_setopt($rest,CURLOPT_URL,$url);  
 curl_setopt($rest,CURLOPT_HTTPHEADER,$headers);
 //curl_setopt($rest, CURLOPT_USERPWD, "info@nitsudinc.com:XYkBaM57Rk");  
 curl_setopt($rest,CURLOPT_RETURNTRANSFER, true);  
 
 $response = curl_exec($rest);

 $data= json_decode($response,true);  


array_push($publisherDATA,$data);
}


}


    ?>
    <div class="container-fluid">
        <div class="container">
            <div class="title"><h1>Publishers</h1></div>
                <div class="row">
                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">

        <thead>
            <tr>
                  <th>Publisher</th>
                  <th>Publish Date </th>
                <th>Title</th>
                <th>ISBN10</th>
                <th>ISBN13</th>
                <th>MSRP</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    foreach ($publisherDATA as $bookdataA) {
                     
                        
                      if(!empty($bookdataA['books'])){

                      foreach($bookdataA['books'] as $bookdata ){ 

                     
                        ?>
                      
            <tr>
           


              <td>
                   <?php 

                   if(isset($bookdata['publisher']))
                   {
                      echo $bookdata['publisher'];
                   }


                 ?> 
                </td>
                 <td>
                   <?php 

                   if(isset($bookdata['date_published']))
                   {
                      echo $bookdata['date_published'];
                   }


                 ?> 
                </td>
                <td>
                <?php 

                   if(isset($bookdata['title']))
                   {
                      echo $bookdata['title'];
                   }


                 ?> 
                 
                </td>
                 
                <td>       <?php 

                   if(isset($bookdata['isbn']))
                   {
                      echo $bookdata['isbn'];
                   }


                 ?> 
             </td>
                <td>   <?php 

                   if(isset($bookdata['isbn13']))
                   {
                      echo $bookdata['isbn13'];
                   }


                 ?>   </td>
                <td>    <?php 

                   if(isset($bookdata['msrp']))
                   {
                      echo $bookdata['msrp'];
                   }


                 ?>  
                   </td>
            </tr>
            <?php
                    }
                  
                  
                }
                }
                ?>
            
           
        </tbody>
        <tfoot>
            <tr>
                  <th>Publisher</th>
                       <th>Publish Date </th>
                <th>Title</th>
                <th>ISBN10</th>
                <th>ISBN13</th>
                <th>MSRP</th>
            </tr>
        </tfoot>
    </table>
                </div>
              </div>
          </div>
<?php
curl_close($rest);
?>
<script type="text/javascript">
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: false
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );



</script>          
</body>
</html>