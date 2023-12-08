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
                                <h2 style="color: #333333;line-height: 30px;" ><?= $model['regno']?> : تحديث التصنيف – إكمال عملية الدفع</h2>
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
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: right;" ><span style="text-align: right; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" >مرحبا </span></span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: right;" ><span style="text-align: right; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;line-height: 26px;" ><?php if ($stktype == 6) {echo "يرجى العثور على الفاتورة الأولية للمورد لتصنيف الشركة المحدث.";} else {echo "يرجى العثور على الفاتورة الأولية للمورد لتصنيف الشركة المحدث.";}?></span></span>
                                    </p>
                                    <p class="text_lead text_secondary mb_md" style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: right;" ><span style="text-align: right; font-size: 16px;" ><span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" ><strong><?= $model['suppliercode_ar'].': '.$model['regno'] ?></strong></span></span>
                                    </p>
                                    <tr>
                                        <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " >
                                            <p class="text_lead text_secondary mb_md" style="margin-top: 10px; margin-bottom: 15px; word-break: break-word; text-align: center;" >
                                                 <span style="font-family: Arial;" > <span style="font-size: 16px;" ><span class="col_bus" style="color: #333333; text-decoration: underline;" ><b>تفاصيل الشركة</b></span> </span>
                                                </span>
                                            </p>
                                            <table role="presentation" class="ebutton mce-item-table" align="right" border="0" cellspacing="0" cellpadding="0" style=" text-size-adjust: 100%;" >
                                                <tbody>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;اسم الشركة:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" > <strong>&nbsp;:&nbsp;<?= (!empty($model['Company_ar']))? $model['Company_ar']: $model['Company_en'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;الدولة:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= (!empty($model['country_ar']))? $model['country_ar']: $model['country'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;التصنيف الحالي:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= (!empty($model['classification_oldar']))? $model['classification_oldar']: $model['classification_old'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;التصنيف الجديد:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= (!empty($model['classification_newar']))? $model['classification_newar']: $model['classification_new'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;البريد الإلكتروني:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= $model['emailid'] ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text_lead text_secondary mb_md" style="color: rgb(51, 51, 51); font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;" >
                                                <br>
                                            </p>
                                        </td>
                                    </tr>
                                    <!-- Primary Contact -->  
                                    
                                    <tr>
                                        <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " >
                                            <p class="text_lead text_secondary mb_md" style="margin-top: 10px; margin-bottom: 15px; word-break: break-word; text-align: center;" >
                                                 <span style="font-family: Arial;" > <span style="font-size: 16px;" ><span class="col_bus" style="color: #333333; text-decoration: underline;" ><b>جهة الاتصال لعملية الدفع</b></span> </span>
                                                    </span>
                                                </a>
                                            </p>
                                            <table role="presentation" class="ebutton mce-item-table" align="lerightft" border="0" cellspacing="0" cellpadding="0" style=" text-size-adjust: 100%;" >
                                                <tbody>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;الاسم:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" > <strong>&nbsp;:&nbsp;<?= $model['contname'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;القسم:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= $model['contdepartment'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;المسمى الوظيفي:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= $model['contdesignation'] ?></strong></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;البريد الإلكتروني:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= $model['contemail'] ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td nowrap width="40%" style="text-align: right;width:30%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px; margin-bottom: 10px;" >&nbsp;&nbsp;&nbsp;الهاتف المحمول:</p> </td>
                                                        <td nowrap width="60%" style="text-align: right;width:70%;font-size: 16px;font-family: Arial;" ><p style="margin-top: 0px;margin-bottom: 10px;" ><strong>&nbsp;:&nbsp;<?= $model['contmob'] ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text_lead text_secondary mb_md" style="color: rgb(51, 51, 51); font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;" >
                                                <br>
                                            </p>
                                        </td>
                                    </tr>
                                    <table role="presentation" class="ebutton mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" style="color: rgb(51, 51, 51); text-size-adjust: 100%; margin: 0px auto;" >
                                        <tbody>
                                            <tr>
                                                <td class="column_cell" style="font-family: Arial, Helvetica, sans-serif;color: #ffffff;font-weight: bold; background-color: #4ca0ab; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; text-size-adjust: 100%; font-size: 16px;padding: 10px 24px; border-radius: 2px; line-height: normal; text-align: center; font-weight: bold;" ><a class="column_cell" href="<?= $model['login_link'] ?>"  target="_blank" style="cursor:pointer;color: #ffffff;text-decoration: none;font-weight: bold;" rel="noopener"><span class="column_cell">عرض التفاصيل</span></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="text_lead text_secondary mb_md" style="color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;" >
                                        <br>
                                    </p>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>