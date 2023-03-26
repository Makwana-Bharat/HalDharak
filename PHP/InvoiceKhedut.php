<?php
    session_start();
    include("Connection.php");
    $date=date('d/m/Y');
    $query="SELECT * FROM `khedut_master` WHERE ID=".$_SESSION['ID'];
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        echo '<p class="w-75"><b>ખેડૂત નામ : </b><span id="InvoiceName">'.$row['NAME'].' </span></p>
                    <p class="w-25  d-flex  justify-content-end"><b>ગામ : </b><span >'.$row['VILLAGE'].'</span>
                    </p>
                    <p class="w-25  d-flex  justify-content-end"><b>તારીખ : </b><span >'.$date.'
                      </span>
                    </p>';
    }
?>