<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <table style=" ">
        <tr>
            <td>
                <table style="padding-bottom: 0px;">
                    <tr>
                        <td> 							
							<?php echo $profileimage ?>                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- <img src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/ar/views/pdf/qr.jpg" alt="avatar" style="width:40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px"> -->
                            <?php echo $qrcode ?>
                        </td>

                    </tr>
                </table>
                <table style="padding-left: 20px; padding-top: -10px;">
                    <tr>
                        <td>
                            <!-- <p style="font:IBM Plex Sans 6 Regular;color:#000000;">www.Olearning.com</p> -->
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="padding-top:70px; ">
                    <tr>
                        <td>
                            <!-- <img src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/ar/views/pdf/logo.png" alt="avatar" style="width:120px; height:50px;padding-left:20px;padding-top:15px;padding-right:40px;padding-bottom:5 px"> -->
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:10px;">
                            <p style="font:Segoe UI 13   bold;color:#000000 ;padding-bottom : 5px;padding-top:0px; "> <?= $userdata['title'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=" font:Segoe UI 11 Regular;color: #000000;padding-bottom : 5px"> Name: <?= $userdata['name'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=" font:Segoe UI 11 Regular;color: #000000;padding-bottom : 5px">Verification no.: <?= $userdata['verificationcode'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style=" font:Segoe UI 11 Regular;color: #000000;padding-bottom : 5px">Issue Date: <?= $userdata['issuedata'] ?></p>
                        </td>
                    </tr>
                    <?php if($userdata['nolice'] == 1){ ?>
                    <tr>
                        <td style="padding-bottom:10px">
                            <p style=" font:Segoe UI 11 Regular;color: #000000;">ROP License No.: <?= $userdata['licNo'] ?>
                            </p>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <td style="padding-bottom:10px">
                            <p style=" font:Segoe UI 11 Regular;color: #000000;">ID Number: <?= $userdata['civilno'] ?>
                            </p>
                        </td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td>
                            <!-- <p style="font:Segoe UI 8 Regular;color:#FF3939;">This card is Not valid without ROP Licence -->
                            </p>
                        </td>
                    </tr>

                </table>
                <table style="margin-left: 150px; margin-top: 10px;">
                    <tr>
                        <td>
                            <!-- <p style="font:Segoe UI 8 Regular;color: #FF3939; text-align:center;">0000038651 -->
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
   
    <div style=" ">
        <table style="padding-top:40px; margin-right:20px; margin-left:20px; width:100%; border-spacing: 0; border-width: 0; ">
            <tr>
                <td style="width:65%; margin: 0px !important; padding:0px !important; border:1px solid #000; border-bottom:none;">
                    <table style="  width:100%; border-spacing: 0; border-width: 0; padding: 0;">
                        <tr style="margin: 0px; ">
                            <td style=" margin: 0px; border-bottom:1px solid #000; background-color:#c0c0c0; padding-left:5px;">
                            <p style=" font:Segoe UI 8 Regular;color: #000000;padding-bottom : 5px; "> Category</p>
                            </td>
                        </tr>
                        <?php foreach($userdata['cattable'] as $item){ ?>
                        <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; background-color:#c0c0c0; padding-left:5px;">
                            <p style=" font:Segoe UI 8 Regular;color: #000000;padding-bottom : 5px; "><?= $item['cate'] ?></p>
                            </td>
                        </tr>
                        <?php } ?>
                        <!-- <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; background-color:#c0c0c0; padding-left:5px;">
                            <p style=" font:Segoe UI 6 Regular;color: #000000;padding-bottom : 5px; ">  Heavy Vehicles</p>
                            </td>
                            
                        </tr>
                        <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; background-color:#c0c0c0; padding-left:5px;">
                            <p style=" font:Segoe UI 6 Regular;color: #000000;padding-bottom : 5px; "> Graded Road</p>
                            </td>
                            
                        </tr> -->
                    </table>
                </td>
                <td style="width:35%; margin: 0px !important; padding:0px !important; border:1px solid #000; border-left:none;border-bottom:none;">
                    <table style="  width:100%; border-spacing: 0; border-width: 0; padding: 0;">
                        <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; padding-left:5px;">
                            <p style=" font:Segoe UI 8 Regular;color: #000000;padding-bottom : 5px;">  Expiry Date</p>
                            </td>
                        </tr>
                        <?php foreach($userdata['expirytable'] as $item){ ?>
                        <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; padding-left:5px;">
                            <p style=" font:Segoe UI 8 Regular;color: #000000;padding-bottom : 5px;"><?= $item['date'] ?></p>
                            </td>
                        </tr>
                        <?php } ?>
                        <!-- <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; padding-left:5px;">
                            <p style=" font:Segoe UI 6 Regular;color: #000000;padding-bottom : 5px;">  26-05-2024</p>
                            </td>
                        </tr>
                        <tr style="margin: 0px;">
                            <td style=" margin: 0px; border-bottom:1px solid #000; padding-left:5px;">
                            <p style=" font:Segoe UI 6 Regular;color: #000000;padding-bottom : 5px;"> No Expiry</p>
                            </td>
                        </tr> -->
                    </table>  
                </td>
            </tr>
        </table> 
    </div>
</body>

</html>