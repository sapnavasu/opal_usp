<html>

<head>
</head>

<body style="margin:0;padding:0;">

<div style="width:100%;height:100%; background: url('<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/st/pdf/front.png'); background-size: cover; background-repeat: no-repeat; padding: 7pt 14pt; width: 100%;">
        <table style="width:100%; border-collapse:collapse;border:0;border-spacing:0;">
        <tr>
        <td>
        <table style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td style="padding:0px;">
              <table style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                    <td style="width:47%;">
                    <img src="<?=$data['profile']?>" style="padding-left:12pt; width:95pt; height:85pt;"></img>
                    </td>
                    <td style="width:50%;color:#153643; padding-bottom:12pt">
                        <table style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>    
                                <td>
                                    <img src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/st/pdf/logo.png">
                                </td>
                            </tr>
                            <tr>
                                <td style="color:#153643; padding-top:20pt; padding-left:17pt;">
                                    <h1 style="font-size: 16pt; font-weight: 600; color: #000;">
                                        <b><?=$data['training']?'Competent Trainer':'Competent Inspector'?></b>
                                    </h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
              </table>
            </td>
          </tr>
            
          <tr>
            <td style="padding-top:7pt;">
              <table style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="">
                    <table style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        <td style="width:45%;padding:0;vertical-align:top;color:#153643;">
                        <?php echo $qrcode ?>
                        </td>
                        <td style="width:55%;padding:0;vertical-align:top;color:#153643; padding-top:10pt; padding-left:13pt">
                            <table>
                                <tbody>
                                    <tr>

                                        <td valign="top" style="color: #807c7c; font-size: 11pt; font-weight: 700; vertical-align: top; left; min-height: 20px;">Name <?=str_repeat('&nbsp;', 2)?></td>
                                        <th nowrap style="border-bottom: none; font-size: 11pt;font-weight:800; vertical-align: top; padding-left: 2pt; height: 20px; text-align: left;">: <span style="word-break: break-word;"><?=$data['name']?></span></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #807c7c; font-size: 11pt; font-weight: 700;text-align: left;">Verification Code <?=str_repeat('&nbsp;', 2)?></td>
                                        <th style="border-bottom: none; font-size: 11pt;font-weight:800; padding-left: 2pt; height: 20px; text-align: left;">: <?=$data['code']?></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #807c7c; font-size: 11pt; font-weight: 700;text-align: left;">Issue Date <?=str_repeat('&nbsp;', 9)?></td>
                                        <th style="border-bottom: none; font-size: 11pt;font-weight:800; padding-left: 2pt; height: 20px; text-align: left;">: <?=$data['issuedate']?></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #807c7c; font-size: 11pt; font-weight: 700;text-align: left;">ID Number <?=str_repeat('&nbsp;', 10)?></td>
                                        <th style="border-bottom: none; font-size: 11pt;font-weight:800; padding-left: 2pt; height: 20px; text-align: left;">: <?=$data['id_number']?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <tr>
                  <td style="padding-top:20pt">
                    <p><b>www.<span style="color:red;">usp.opaloman</span>.om</b></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>        
        </table>
      </td>
        </tr>
        </table>
    </div>

<!-- <div style=" width:100%; background: url('<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/st/pdf/front.png'); background-size: cover; height:100%; background-repeat: no-repeat;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
    <tr>
      <td style="padding:0;">
        <table role="presentation" style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td style="padding:36px 30px 42px 30px;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0; padding:30px">
                <tr>
                    <td style="width:50%;vertical-align:middle;" >
                        <p style="width:280px; height: 300px;">
                        <img  style="width:100%; height:100%; ">
                            <?php echo $qrcode ?>
                        </img>
                        </p>
                    </td>
                    <td style="width:50%;padding:0;vertical-align:top;color:#153643;" align="center">
                        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                            <tr>
                                <td style="width:180px;padding:0;vertical-align:top;">
                                    <p style="">
                                    <img src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/st/pdf/logo.png"
                                        style="width: 100%; height:100%;">
                                    </p>
                                </td>
                            </tr>
                            <tr style="padding-t0p:80px;">
                                <td style="color:#153643;">
                                    <h1 style="font-family:arial; font-size: 40px; font-weight: 800; color: #000;">
                                        <?=$data['training']?'Compentent Trainer':'Compentent Inspector'?>
                                    </h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
              </table>
            </td>
          </tr>
            
          <tr>
            <td style="padding:36px 30px 42px 30px;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="padding:0;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        <td style="width:50%;padding:0;vertical-align:top;color:#153643;">
                            <p style="width:280px; height: 300px;">
                                <img  style="width:100%; height:100%; ">
                                    <?php echo $qrcode ?>
                                </img>
                            </p>
                        </td>
                        <td style="width:50%;padding:0;vertical-align:top;color:#153643;" align="center">
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="color: #a9a9a9; font-family:arial; font-size: 16px; font-weight: 700;text-align: left;">Name  :</td>
                                        <th style="border-bottom: none; font-size: 8px; padding-left: 5px; height: 20px; text-align: left;"><?=$data['name']?></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #a9a9a9; font-family:arial; font-size: 16px; font-weight: 700;text-align: left;">Verification Code  :</td>
                                        <th style="border-bottom: none; font-size: 8px; padding-left: 5px; height: 20px; text-align: left;"><?=$data['code']?></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #a9a9a9; font-family:arial; font-size: 16px; font-weight: 700;text-align: left;">Issue Date  :</td>
                                        <th style="border-bottom: none; font-size: 8px; padding-left: 5px; height: 20px; text-align: left;"><?=$data['issuedate']?></th>
                                    </tr>
                                    <tr style="">
                                        <td style="color: #a9a9a9; font-family:arial; font-size: 16px; font-weight: 700;text-align: left;">ID Number  :</td>
                                        <th style="border-bottom: none; font-size: 8px; padding-left: 5px; height: 20px; text-align: left;"><?=$data['id_number']?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>        
        </table>
      </td>
    </tr>
  </table>
  </div> -->

  <pagebreak/>
    <!-- Second Page start -->
    <div style="background: url('<?php echo \Yii::$app->params['backendBaseUrl']; ?>/api/modules/st/pdf/back.png'); background-size: cover; background-repeat: no-repeat; padding: 20px ; width: 100%; position: relative; min-height: 100vh; height:100%">
        <h1 style="font-size: 8px; color: #000; font-weight: bold; margin-bottom: 7px;">The Holder of this card is approved for the following</h1>
        <div style="height: 58%;">
        <table style="width: 100%;" cellspacing="0" cellpadding="0">
            <tr style="margin: 0px;">
                <th style="font-size: 8px; padding-left: 5px; border: 1px solid #dddddd; border-radius: 10px 0 0 0; border-right: none; height: 20px; text-align: left; background-color: #f5f8fa; ">
                <?=$data['training']?'Course':'Category'?>
                </th>

                <th style="border: 1px solid #dddddd; text-align: left; border-right: none; padding-left: 5px; font-size: 8px; height: 20px; background-color: #f5f8fa;">Roles</th>

                <th style="border: 1px solid #dddddd; text-align: left; background-color: #f5f8fa; padding-left: 5px; border-top-right-radius: 25px; font-size: 8px; height: 20px;">Date Of Expiry</th>
            </tr>
            <?php foreach($data['course'] as $d){ ?>
                <tr>
                    <td style="border: 1px solid #dddddd; border-top: none; border-right: none; text-align: left; padding: 5px; background-color: #fff; font-size: 8px;"><?=$d['course']?></td>
                    <td style="border: 1px solid #dddddd; border-top: none; border-right: none; text-align: left; padding: 5px; font-size: 8px; background-color: #fff;"><?=$d['roles']?></td>
                    <td style="border: 1px solid #dddddd; border-top: none; text-align: left; padding: 5px; font-size: 8px; background-color: #fff;"><?=$d['expiry']?></td>
                </tr>
            <?php }?>
        </table>

        </div>
        
        <div style="position: fixed; bottom: 3px;">
          <h1 style="font-size: 8px; color: #000; font-weight: 700; font-style: italic; text-align: center; margin-top: 0px;">
              This card is property of Oman Energy Association(OPAL).<br />if lost and found, please report to, +968 246054700
          </h1>
        </div>
        
    </div>

</body>

</html>