<table class="content_column md_mx mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="padding:15px;border-radius: 5px;width:80%;text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt; background:#fff;" data-mce-style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
    <tbody>
          <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md" style="margin-bottom: 25px; word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;padding:0px 0px 15px 0px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;">  <?php  $courseData[companyName]; ?> 
                        </span></span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md" style="margin-bottom: 25px; word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;padding:0px 0px 15px 0px;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;" data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 16px;" data-mce-style="font-size: 16px;"> Please note that your payment towards the Site Audit for the <?= $courseData['projectname']; ?> Renewal was <b>not received</b>. Kindly try again through alternate payment method.
                        </span></span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="column_cell md_px" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px " data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <table width="100%" role="presentation" class="ebutton mce-item-table" align="left" border="0" cellspacing="0" cellpadding="0" style="width:100%; text-size-adjust: 100%;" data-mce-style="width:100%;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tbody>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Application Reference Number</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?= $courseData['appno'] ?>
                                </p>
                            </td>
                        </tr>
        
                          
                            <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Office Type</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?php if($courseData['officeType']=='1'){
                                        echo 'Main Office'; }elseif($courseData['officeType']=='2'){
                                        echo 'Branch Office';}else{
                                        echo '-' ;
                                        } ?>
                                </p>
                            </td>
                            </tr>
                           
                              <tr>
                                   <?php if($courseData['branchName']){ ?>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Branch Name</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?= $courseData['branchname'] ?>
                                </p>
                            </td>
                            
                              </tr>
                                  <?php } ?>
                              
                            <tr>                            
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Course Title</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?= $courseData['coursetitle'] ?>
                                </p>
                            </td>
                            </tr>
                             <tr>                            
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Course Category</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?= $courseData['coursecategory'] ?>
                                </p>
                            </td>
                            </tr>
                            <tr>                            
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Requested for</p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    :&nbsp;<?= $courseData['requestedfor'] ?>
                                </p>
                            </td>
                            </tr> 
                                <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Comments</p>
                            </td>
                              <td nowrap width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">:</p>
                                </td>
                             <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                <?= $courseData['comments'] ?>
                                </p>
                            </td>
                          </tr>
              
                </tbody>
                </table>

         
                    </tbody>
                </table>

<table role="presentation" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; cursor: pointer; text-size-adjust: 100%; margin: 0px auto;" data-mce-style="background-color:#fff; cursor:pointer; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0 auto;">
    <tbody>
        <tr>
            <td class="column_cell" style="font-family: Arial, Helvetica, sans-serif;color: #ffffff;font-weight: bold; background-color: #e20516; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-size: 16px; min-width: 192px; padding: 13px 24px; border-radius: 2px; line-height: normal; text-align: center; font-weight: bold; " data-mce-style="color:#fff !important; background-color: #f5821f; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-size: 16px; min-width: 192px; padding: 13px 24px; border-radius: 2px; line-height: normal; text-align: center; font-weight: bold;">
                <a class="column_cell"  href="<?= $navlink ?>" target="_blank" style="cursor:pointer;color: #ffffff;text-decoration: none;font-weight: bold;" data-mce-style="color: #ffffff;text-decoration: none;font-weight: bold;cursor:pointer;"><span class="column_cell">Complete Payment</span></a>
            </td>
        </tr>
    </tbody>
</table>