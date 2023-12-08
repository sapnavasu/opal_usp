<meta charset="UTF-8">
<style>
     .column_cell a:visited {
      color: #4aa1ac;
     }
     a,a:visited {
        color:#006cb7;
     }
</style>
<table class="content_column md_mx mce-item-table" align="center" border="0" cellspacing="0" cellpadding="0"
    width="100%"
    style="padding:15px;border-radius: 5px;width:80%;text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt; background:#fff;"
    data-mce-style="text-align: center;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
    <tbody>
        <tr>
            <td class="column_cell md_px"
                style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding-bottom: 10px;"
                data-mce-style="padding-bottom: 10px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
                <?php if($status == 'A'){  ?>
                <p class="text_lead text_secondary mb_md"
                    style="margin-bottom: 25px; word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;"
                    data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;"
                        data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span
                            style="font-size: 16px;" data-mce-style="font-size: 16px;">Congratulations on successfully completing the Course. You can collect your OPAL Permit Card from the Training Evaluation Centre. The course details are listed below:</span></span>
                </p>
                <?php } ?>
                <?php  if($status == 'F'){  ?>
                <p class="text_lead text_secondary mb_md"
                    style="margin-bottom: 25px; word-break: break-word; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;"
                    data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif; margin-bottom: 25px; word-break: break-word; font-size: 16px; line-height: 26px; margin-left: 0px; margin-right: 0px; text-size-adjust: 100%; text-align: left;">
                    <span style="color: #333333; font-family: Arial, Helvetica, sans-serif;"
                        data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span
                            style="font-size: 16px;" data-mce-style="font-size: 16px;">We regret to inform you that you have not passed the Course (<?= $model['subtitle'] ?>). The Assessment Result of the Course is listed below:</span></span>
                </p>
                <?php } ?>
        <tr>
            <td class="column_cell md_px"
                style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding: 0px "
                data-mce-style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0pt;mso-table-rspace: 0pt;padding:0px;">
                <table width="100%" role="presentation" class="ebutton mce-item-table" align="left" border="0"
                    cellspacing="0" cellpadding="0" style="width:100%; text-size-adjust: 100%;"
                    data-mce-style="width:100%;-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                    <tbody>
                        <tr>
                            <td nowrap width="40%"  valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Training Evaluation Centre</p></strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;">
                                   <?= $model['tpname'] ?>
                                </p>
                            </td>
                        </tr>
                        <tr style="display: table-row;">
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Assessment Centre</p></strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $model['assessCentr_en']  ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Batch Number</p></strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                   <?= $model['batchNo'] ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Batch Type</p></strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $model['batchType']  ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Course Sub-category</p></strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                   <?= $model['subtitle'] ?>
                                </p>
                            </td>
                        </tr>
                        <?php if($status == 'F'){  ?>
                        <?php if($model['kassessmentstatus']){ ?>
                        <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Knowledge Assessment</p><strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                                    <?= $model['kassessmentstatus']?$model['kassessmentstatus']:'-' ?>
                                </p>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <?php if($model['passessmentstatus']){ ?>
                        <tr>
                            <td nowrap width="40%" valign="top"
                                style="text-align: left;width:30%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:30%;font-size: 16px;font-family: Arial;">
                                <strong><p style="margin-top: 0px; margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">Practical Assessment</p><strong>
                            </td>
                            <td  width="2%" valign="top"
                                style="text-align: left;width:2%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:2%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px;font-weight: bold;margin-right: 10px;">
                                    :
                                </p>
                            </td>
                            <td  width="58%"
                                style="text-align: left;width:68%;font-size: 16px;font-family: Arial;"
                                data-mce-style="text-align: left;width:68%;font-size: 16px;font-family: Arial;">
                                <p style="margin-top: 0px;margin-bottom: 10px;"
                                    data-mce-style="margin-top: 0px;margin-bottom: 10px">
                              <?= $model['passessmentstatus']?$model['passessmentstatus']:'-' ?>
                                </p>
                            </td>
                        </tr>
                        <?php } 
                         } ?>
                    </tbody>
                </table>
                <p class="text_lead text_secondary mb_md"
                    style="color: rgb(51, 51, 51); font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;"
                    data-mce-style="color: #333; font-family: Arial; margin-top: 0px; margin-bottom: 10px; word-break: break-word; font-size: 16px;">
                    <br>
                </p>
            </td>
        </tr>
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
                        data-mce-style="color: #333333; font-family: Arial, Helvetica, sans-serif;"><span
                            style="font-size: 16px;" data-mce-style="font-size: 16px;"><a data-mce-href="<?= $model['link'] ?>" href="<?= $model['link'] ?>">Click here</a> to submit your feedback on the above completed course.</span></span>
                </p>
            </td>
        </tr>
    </tbody>
</table>