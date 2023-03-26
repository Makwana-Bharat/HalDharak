<?php
    include("Connection.php");
    $query="SELECT * FROM `invoice` WHERE MFID=".$_POST['SFID'];
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $Invoice='';
        while($row=mysqli_fetch_assoc($result)){    
            if($row['TYPE']!='જમા ')
                $Invoice=$Invoice.'<tr id="'.$row['IID'].'" onmouseover="Oparetion(`Child'.$row['IID'].'`,``)" onmouseleave="Oparetion(`Child'.$row['IID'].'`,`none`)"><td>'.$row['RUPEE'].'</td ><td>'.$row['DATE'].'</td><td style=" text-align:right;border-right:1px solid gray padding:0" >'.$row['DETAILS'].'<span id="Child'.$row['IID'].'" style="width:fit-content;display:none"><i class="mdi mdi-lead-pencil text-success" style="font-size:large;margin-left:10px;" onclick="EditEntry('.$row['IID'].',`'.$row['RUPEE'].'`,`'.$row['DATE'].'`,`'.$row['DETAILS'].'`,`ઉધાર`)"></i><i class="mdi mdi-delete-outline text-danger" style="font-size:large;margin-left:10px" onclick="DeleteEntry('.$row['IID'].')"></i></span></td></tr >';
        }
        echo $Invoice;
    }
?>