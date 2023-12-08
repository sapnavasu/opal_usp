<table class="content_column md_mx mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:15px;border-radius: 5px;width:80%;text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt; background:#fff;" data-mce-style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
    <tbody>
          <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md" style=" word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;padding:0px 0px 15px 0px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;">
                               <?php
                               
                               $learnerName = $learnerBulkData['learnerName'][0];
                                echo $learnerName; 

                             ?>,
                        </span></span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md" style=" word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;padding:0px 0px 15px 0px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;"> You have successfully completed Theoretical Training and can now move on to Practical Training. The Course details are listed below. 
                        </span></span>
                </p>
            </td>
        </tr>
        

        <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <table width="100%" role="presentation" class="ebutton mce-item-table" align="left" border="0" cellspacing="0" cellpadding="0" style="width:100%; text-size-adjust: 100%;" data-mce-style="width:100%;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tbody>
                                               
       
                        <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                   data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Training Evaluation Centre</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['batchtpname'] ?>
                                </p>
                            </td>
                        </tr>
                      <?php if($learnerBulkData['diffcen']==17){?>
                        <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Centre Location</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['city'] ?> , <?= $learnerBulkData['state'] ?> 
                                </p>
                            </td>
                        </tr>
                      <?php } ?>
                         <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Batch Number</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['batchNo'] ?>
                                </p>
                            </td>
                        </tr>
                            <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Batch Type</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['batchtype'] ?>
                                </p>
                            </td>
                        </tr>
                         <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Course Sub-category</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['subcategory'] ?>
                                </p>
                            </td>
                         </tr>
<!--                         Code Test-->
                 
                         <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Training Duration (Practical)</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['practicalStdt'] ?>  to <?= $learnerBulkData['practicalEnddt'] ?> 
                                </p>
                            </td>
                        </tr>
                        
<!--Code not reflected-->
                         <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Assessment Date and Time</strong></p>
                            </td>
                            <td width="2%" valign="top" style="padding-right: 4px;padding-top:0;text-align: left;font-size: 16px;font-family: Arial;" data-mce-style="padding-top:15px;text-align: left;font-size: 16px;font-family: Arial;"><strong>:</strong></td>
                            <td  width="60%"  valign="top"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $learnerBulkData['accessmentdate'] ?>(<?= $learnerBulkData['accesstarttime'] ?> - <?= $learnerBulkData['accesendtime'] ?>) 
                                </p>
                            </td>
                        </tr>
            
         
                        
                    </tbody>
                </table>
                <p class="text_lead text_secondary mb_md" style="color: rgb(51, 51, 51); font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;" data-mce-style="color: #333; font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;">
                    <br>
                </p>
            </td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
    <td class="column_cell md_px" style="margin-left: 15px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 10px 55px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px 15px;margin-left: 15px;">
        <p class="text_lead text_secondary mb_md" style="margin-top: -13px;  word-break: break-word; text-align: left;line-height: 26px" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 20px; word-break: break-word; font-size: 16px; text-align: left;line-height: 26px">
            <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;line-height:26px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;">We wish you all the best towards successfully completing the Training</span></span>
        </p>
    </td>
    </tr>
    <tr>
    <td class="column_cell md_px" style="margin-left: 15px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 10px 55px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px 15px;margin-left: 15px;">
        <p class="text_lead text_secondary mb_md" style="margin-top: -10px; margin-left: 3px; word-break: break-word; text-align: left;line-height: 26px" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 20px; word-break: break-word; font-size: 16px; text-align: left;line-height: 26px">
            <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;line-height:26px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;">For any queries, kindly contact the Training Evaluation Centre.</span></span>
        </p>
    </td>
</tr>
    </tbody>
</table>
