<?php
session_start();
$SID=$_SESSION['SID'];
    include("Connection.php");
    if($con=="Server Error")
    {
        echo "Server Error";
    }
    else
    {

    $query="SELECT * FROM `khedut_master` WHERE SID=$SID ORDER BY NAME";
    
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $arryKhedut=array();
        $i=0;
        while($row=mysqli_fetch_assoc($result)){
            $arryKhedut[$i]=$row;
           $i++;
            $date=date('d/m/Y');
            $Rupee="0";
            $ID=$row['ID'];
            $query2="SELECT * FROM `invoice` WHERE MFID IN(SELECT MFID FROM `main_folder` WHERE ID=$ID)";
           $result2=mysqli_query($con,$query2);
           while($row2=mysqli_fetch_assoc($result2))
           {
            if($row2['TYPE']=='જમા ')
                $Rupee+=$row2['RUPEE'];
            else
                $Rupee-=$row2['RUPEE'];
            $date=$row2['DATE'];
           }
            $statuscolor=($Rupee==0 ? 'info' : ($Rupee>0 ? 'success' : 'danger') );
           $status=($Rupee==0 ? 'પૂર્ણ' : ($Rupee>0 ? 'જમા' : 'બાકી') );
            echo '<tr id="'.$row['ID'].'">
        <td onclick="ViewKhedut('.$row['ID'].',`'.$row['NAME'].'`,`'.$row['PIC'].'`,`'.$Rupee.'`,`'.$row['VILLAGE'].'`,`'.$row['MOBILE'].'`)">
            '.$row['NAME'].'
        </td>
        <td onclick="ViewKhedut('.$row['ID'].',`'.$row['NAME'].'`,`'.$row['PIC'].'`,`'.$Rupee.'`,`'.$row['VILLAGE'].'`,`'.$row['MOBILE'].'`)"><label  id="status'.$row['ID'].'" class="badge badge-gradient-'.$statuscolor.'">'.$status.'</label> </td>
        <td   class="text-'.$statuscolor . '" onclick="ViewKhedut('.$row['ID'].',`'.$row['NAME'].'`,`'.$row['PIC'].'`,`'.$Rupee.'`,`'.$row['VILLAGE'].'`,`'.$row['MOBILE'].'`)">
            <input type="text" id="Rupee'.$row['ID'].'" value="'.$Rupee.'" disabled hidden/>    
        <span id="Rupee2'.$row['ID'].'">₹'.$Rupee.'</span> 
        </td>
        <td id="Date'.$row['ID'].'" onclick="ViewKhedut('.$row['ID'].',`'.$row['NAME'].'`,`'.$row['PIC'].'`,`'.$Rupee.'`,`'.$row['VILLAGE'].'`,`'.$row['MOBILE'].'`)">  '.$date.' </td>
        <td><span class="  bg-gradient-success text-white m-1 rounded-2" style="width:40px;padding:10px 20px;" onclick="EditKhedut('.$row['ID'].',`'.$row['NAME'].'`,`'.$row['PIC'].'`,`'.$Rupee.'`,`'.$row['VILLAGE'].'`,`'.$row['MOBILE'].'`)"><i class="mdi mdi-border-color" style="font-size:large"></i></span><span class="  bg-gradient-danger text-white rounded-2" style="width:40px;padding:10px 20px;" onclick="DeleteKhedut('.$row['ID'].')"><i class="mdi mdi-delete" style="font-size:large"></i></span> </td>
    </tr>';
    
        }
        $_SESSION['KhedutName']=$arryKhedut;
    }

    else
        echo "કોય ખેડૂત નથી.. ";
    }
?>