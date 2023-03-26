<?php
session_start();
$_SESSION['ID']=$_POST['ID'];
include("Connection.php");
$query="SELECT * FROM `main_folder` WHERE ID=".$_POST['ID'];
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)>0){
        $Folder='';
        
        while($row=mysqli_fetch_assoc($result)){
        $MFID=$row['MFID'];
        $ID=$_POST['ID'];
            $folderStatus='';
        $Rupee="0";
       $query2=$query2="SELECT * FROM `invoice` WHERE MFID IN(SELECT MFID FROM `main_folder` WHERE ID=$ID AND MFID=$MFID)";
        $result2=mysqli_query($con,$query2);
           while($row2=mysqli_fetch_assoc($result2))
           {
            if($row2['TYPE']=='જમા ')
                $Rupee+=$row2['RUPEE'];
            else
                $Rupee-=$row2['RUPEE'];
           }
            $folderStatus=($Rupee==0 ? 'info' : ($Rupee>0 ? 'success' : 'danger') );
            $Folder=$Folder.'<div  class="folder-'.$row['MFID'].' d-flex flex-column align-items-center folder" style="cursor:pointer" onclick=subfolder('.$row['MFID'].')><i
                  class="mdi mdi-folder text-'.$folderStatus.'" style="font-size: 100px;" id="'.$row['MFID'].'"></i><span
                  style="position:relative;top:-4%">'.$row['Year'].'</span></div><div class="folder-'.$row['MFID'].'" style="height:20px;position:relative;top:12%;right:55px;width:40px;" ><span class="rounded-2" style="width:40px;height:40px;padding:10px 20px;cursor:pointer;color:#ff5349" onclick="DeleteFolder('.$row['MFID'].')"><i class="mdi mdi-delete" style="font-size:25px"></i></span> </div>';
        }
        echo $Folder;
    }
?>