
<table class="content_column md_mx mce-item-table" border="0" cellspacing="0" cellpadding="0" width="100%"
    style="-webkit-box-shadow: 0px 0px 5px -1px rgba(227,224,227,1);
															-moz-box-shadow: 0px 0px 5px -1px rgba(227,224,227,1);
															box-shadow: 0px 0px 5px -1px rgba(227,224,227,1);;padding:20px;border-radius: 5px;width:100%;text-align: left;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt; background:#fff;"
    data-mce-style="text-align: left;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
    <tbody>
        <tr>
            <td class="column_cell md_px"
                style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px "
                data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md"
                    style="margin-top: 0px; margin-bottom: 10px; word-break: break-word; text-align: left;line-height: 26px"
                    data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px; text-align: left;line-height: 26px">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;line-height:26px;"
                        data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span
                            style="font-size: 16px;" data-mce-style="font-size: 16px;"><?= $coursedata['omrm_companyname_en'] ?>
                        </span></span>
                </p>
            </td>
        </tr>
        <tr>
            <td class="column_cell md_px"
                style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px "
                data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <p class="text_lead text_secondary mb_md"
                    style="margin-top: 0px; margin-bottom: 20px; word-break: break-word; text-align: left;line-height: 26px"
                    data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-top: 0px; margin-bottom: 20px; word-break: break-word; font-size: 16px; text-align: left;line-height: 26px">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;line-height:26px;"
                        data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;">
                     
                        <?php if($coursedata['appdt_apptype'] == 3){ ?>
                        <span style="font-size: 16px;" data-mce-style="font-size: 16px;">
                        Your updated Standard / Customised Course Certificate Application has been Declined due to the following reason: 
                        </span>
                        <?php }elseif($coursedata['appdt_apptype'] == 2){ ?>
                            <span  style="font-size: 16px;" data-mce-style="font-size: 16px;">
                            Your Standard / Customised Course Certification Renewal form submitted for Desktop Review has been Declined due to the following reason                       
                            </span>
                             <?php } ?>
                    
                </p>
                <textarea name="" id="" cols="30" rows="10" value="<?= $coursedata['appdt_appdeccomment'] ?>"><?= $coursedata['appdt_appdeccomment'] ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="column_cell md_px"
                style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px "
                data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <table width="100%" role="presentation" class="ebutton mce-item-table" align="left" border="0"
                    cellspacing="0" cellpadding="0" style="width:100%; text-size-adjust: 100%;"
                    data-mce-style="width:100%;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tbody>
                        <b>Centre and Course Details</b>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Application Reference Number</strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['applictionno'] ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Company Name </strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['omrm_companyname_en']  ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Training Provider Name<strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['omrm_tpname_en'] ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Office Type<strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['appiim_officetype'] == 1 ?': Main Office ':'Branch Office'  ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Branch Name<strong>
                                </p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['appiim_officetype'] == 1 ?$coursedata['omrm_companyname_en']:'-'  ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Course Title <strong>
                                </p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['coursename_en'] ?>
                                </p>
                            </td>
                        </tr>
                        <tr>

                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Course Category<strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['courscat_en'] ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px"><strong>Requested for<strong></p>
                            </td>
                            <td  width="60%"
                                style="text-align: left;width:70%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:70%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <strong>:&nbsp;</strong><?= $coursedata['reqfor_en'] ?>
                                </p>
                            </td>
                        </tr>
                        
                        <?php echo ($navlink); ?>
                        <?php echo "---"; ?>
                    <p>Kindly ensure you review and update the Certification form based on the comments and submit again for review. </p>   
                    <button><a href="<?= $navlink ?>">Login to Resubmit </a></button>
                    </tbody>
                </table>
              
               
            </td>
        </tr>
    </tbody>
</table>