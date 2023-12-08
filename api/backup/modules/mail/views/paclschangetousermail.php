<meta charset="UTF-8">
<style>
	 .column_cell a:visited {
       color: #4aa1ac;
	 }
	 a,a:visited {
		color:#006cb7;
	 }
</style>
<div style="background:#f7f7f7;" >
    <table class="content_column mce-item-table" align="center" border="0" width="100%" cellspacing="0" cellpadding="0" style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" >
        <tbody>
            <tr>
                <td class="column_cell" style="background:rgb(247, 247, 247);vertical-align: top;color: #333333;padding-top: 20px;padding-bottom:0;padding-left: 0;padding-right: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" >
                    <table align="center" border="0" cellspacing="0" width="100%" cellpadding="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 0 auto;padding-bottom:10px;" class="mce-item-table">
                        <tbody>
                            <tr>
                                <td class="column_cell md_py" style="font-size: 16px;font-family: Arial, Helvetica, sans-serif;min-width:192px;padding: 13px 20px;border-radius: 2px;line-height: normal;text-align: center;font-weight: bold;" >
                                    <h2 style="color: #333333;line-height: 30px;" ><?= $subject ?></h2>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="column_row" style="font-size: 0; text-align: center;  margin: 0 auto;" >
    <div class="col_3" style="vertical-align: top; display: inline-block; width: 100%; " >
        <br>
    </div>
</div>
<div class="colunm_row md" style="max-width: 100%" >
    <table class="content_column md_mx mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" >
        <tbody>
            <tr>
                <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 20px 20px;" >

                    <table class="content_column md_mx mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;" >
                        <tbody>
                            <tr>
                                <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " >
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: left;" ><span style="text-align: center; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" ><?= $model['Company_en'] ?></span></span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: left;line-height: 26px;" ><span style="text-align: center; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" >During Validation, we have noticed that your Company Classification should be updated to <b><?= $model['ClassificationType'] ?></b></span></span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: left;line-height: 26px;" ><span style="text-align: center; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" >Kindly complete the payment to proceed with the certification process. Post successful payment completion, your updated Company Classification will reflect on your Dashboard and in the RABT <?= $model['suppOrOrg'] ?> Certificate.</span></span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: left;" ><span style="text-align: center; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" ><strong>Attached to this email is the Proforma Invoice copy for your reference.</strong></span></span>
                                    </p>
                                    <table role="presentation" class="ebutton mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" style="color: rgb(51, 51, 51); text-size-adjust: 100%; margin: 0px auto;" >
                                        <tbody>
                                            <tr>
                                                <td class="column_cell" style="font-family: Arial, Helvetica, sans-serif;color: #ffffff;font-weight: bold; background-color: #4ca0ab; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; text-size-adjust: 100%; font-size: 16px;padding: 10px 24px; border-radius: 2px; line-height: normal; text-align: center; font-weight: bold;" ><a class="column_cell" href="<?= $model['login_link'] ?>"  target="_blank" style="cursor:pointer;color: #ffffff;text-decoration: none;font-weight: bold;" rel="noopener"><span class="column_cell">Complete Payment</span></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <p class="text_lead text_secondary mb_md" style="color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;" >
                                        <br>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 15px; word-break: break-word; text-align: left;" ><span style="color: #333333; font-family: verdana;" ><span style="font-size: 16px;" >If you are facing issues with the payment, please write to <a  href="mailto:support@rabt.om" target="_blank" rel="noopener" style="color: #006cb7;" ><span style="text-decoration: underline;">support@rabt.om</span></a> or call +968 2416 6177.</span>
                                        </span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 10px; word-break: break-word; text-align: center; text-size-adjust: 100%;" >
                                        <a style="text-decoration: none;"  href="<?= $model['baseUrl'] ?>" target="_blank" rel="noopener"> 
                                            <span style="font-family: Arial, Helvetica, sans-serif;" > 
                                                <span style="font-size: 16px;">
                                                    <span class="col_bus" style="color: #666;" >www.</span><span class="col_bus" style="color: #dfad66;" >rabt</span><span class="col_bus" style="color: #666; " >.om</span> 
                                                </span>
                                            </span>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>