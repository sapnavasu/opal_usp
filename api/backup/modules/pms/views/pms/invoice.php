<?php
$labelName = '';
if ($invoiceDtls['dataType'] == 1) {
    if ($invoiceDtls['cmsch_contracttype'] == 1) {
        $labelName = 'Contract';
    } else {
        $labelName = 'Subcontract';
    }
} elseif ($invoiceDtls['dataType'] == 2) {
    if ($invoiceDtls['cmsch_contracttype'] == 1) {
        $labelName = 'Purchase Order';
    } else {
        $labelName = 'Suborder';
    }
} elseif ($invoiceDtls['dataType'] == 3) {
    if ($invoiceDtls['cmsch_contracttype'] == 1) {
        $labelName = 'Blanket Agreement';
    } else {
        $labelName = 'Subagreement';
    }
}
?>
<div style="border: 1px solid #d0d1dc;">
    <table style="width:100%;border:none;border-collapse: collapse;line-height:24px" cellspace="0" cellpadding="0">
        <tr style="background: #f5f6fa;">
            <td style="padding:40px 0 15px 15px" valign="top"><img style="height:75px" alt="jsrsnewlogo.png" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png"></td>
            <td style="padding:15px 15px 15px 15px" align="right" valign="top">
                <table>
                    <tr><td nowrap align="left" valign="top" style="color:#006db7;font-size: 24px;font-weight: bold">Tax Invoice</td></tr>
                    <tr><td nowrap align="left" valign="top" style="color:#666666;font-size:14px;white-space: nowrap" nowrap>Invoice Reference No<span style="color:#333333;white-space: nowrap" nowrap>: <?= $invoiceDtls['invoiceNo'] ?></span></td></tr>
                    <tr><td nowrap align="left" valign="top" style="color:#666666;font-size:14px;white-space: nowrap" nowrap>Invoice Date<span style="color:#333333;white-space: nowrap" nowrap>: <?= common\components\Common::ymdhms_to_dmy($invoiceDtls['invoiceDate']); ?></span></td></tr>
                    <tr><td nowrap align="left" valign="top" style="color:#666666;font-size:14px;white-space: nowrap" nowrap>Customer VATIN<span style="color:#333333;white-space: nowrap" nowrap>: <?= (!empty($invoiceDtls['vatNo']) ? $invoiceDtls['vatNo'] : '-'); ?></span></td></tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width:100%;border:none;border-collapse: collapse;margin-top:30px;line-height:24px" cellspace="0" cellpadding="0">
        <tr>
            <td style="width:50%;padding:20px 15px 0 20px;" valign="top">
                <h2 style="color: #333333;font-size: 16px;width:100%;padding:0;margin:0">Billed From</h2> <br>
                <img  alt="bgilogonew.png" style="height:65px;margin-bottom:30px" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrs-logo.jpg">   
                <p style="padding-bottom:10px;font-size: 15px;">Business Gateways International LLC</p>
                <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:24px;" cellspace="0" cellpadding="0">
                    <tr>
                        <td style="width:20%;color:#666666;font-size:14px" valign="top">Address: </td>
                        <td>
                            <p style="color:#333;font-size:14px">Office 14, Building 4,</p>
                            <p style="color:#333;font-size:14px">Knowledge Oasis Muscat (KOM),</p>
                            <p style="color:#333;font-size:14px">Rusayl, Sultanate of Oman.</p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding:15px 0 0 15px; border-left: 1px solid #dadada;" valign="top">
                <h2 style="color: #333333;font-size: 16px;width:100%;padding:0;margin:0">Billed To</h2><br>
                <?php if (!empty($invoiceDtls['companylogo'])) { ?>
                    <img  alt="<?= (!empty($invoiceDtls['jsrsCompanyName']) ? $invoiceDtls['jsrsCompanyName'] : $invoiceDtls['nonJsrsCompanyName']); ?>" style="height:65px;margin-bottom:30px" src="<?= $invoiceDtls['companylogo'] ?>">
                <?php } ?>
                <p style="padding-bottom:10px;font-size: 15px;"><?= (!empty($invoiceDtls['jsrsCompanyName']) ? $invoiceDtls['jsrsCompanyName'] : $invoiceDtls['nonJsrsCompanyName']); ?></p>            
                <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:24px;" cellspace="0" cellpadding="0">
                    <?php if ($invoiceDtls['supplierCode']) { ?>
                        <tr>
                            <td style="color:#666666;font-size:14px;" valign="top" nowrap>Supplier Code: <span style="color:#333;"><?= $invoiceDtls['supplierCode'] ?></span></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td style="color:#666666;font-size:14px" valign="top">Address: <span style="color:#333;"><?php if(!empty($invoiceDtls['mcmpld_address'])){
     echo $invoiceDtls['mcmpld_address'];
                        }  elseif (!empty($invoiceDtls['nonJsrsAddress'])) {
     echo $invoiceDtls['nonJsrsAddress'];                            
                        }  else {
                            echo '-';
                        }  ?>
                            </span></td>
                    </tr>
                    <tr>
                        <?php if (!empty($invoiceDtls['contactName']) || !empty($invoiceDtls['nonJsrsName'])) { ?>
                            <td  style="color:#666666;font-size:14px">Name: <span style="color:#333;"><?= !empty($invoiceDtls['contactName']) ? $invoiceDtls['contactName'] : $invoiceDtls['nonJsrsName']; ?> (<?= !empty($invoiceDtls['contactDesignation']) ? $invoiceDtls['contactDesignation'] : $invoiceDtls['nonJsrsDesignation']; ?>)</span></td>                           
                        <?php } ?>
                    </tr>         
                    <tr>
                        <td style="color:#666666;font-size:14px" valign="top">Mobile: 
                            <?php if (!empty($invoiceDtls['contactMobileNo'] && $invoiceDtls['contactMobileNo'] != null) || !empty($invoiceDtls['nonJsrsMobile']) && $invoiceDtls['nonJsrsMobile'] != null) { ?>
                                <span style="color:#333;"><?= !empty($invoiceDtls['contactDialCode']) ? $invoiceDtls['contactDialCode'] : $invoiceDtls['nonJsrsMobilCC'] . ' ' . !empty($invoiceDtls['contactMobileNo']) ? $invoiceDtls['contactMobileNo'] : $invoiceDtls['nonJsrsMobile']; ?></span>
                            <?php } else { ?>
                                <span style="color:#333;">-</span>
                            <?php } ?>
                        </td>
                    </tr>  
                    <tr>
                        <td style="color:#666666;font-size:14px" valign="top">Email ID: 
                            <?php if (!empty($invoiceDtls['nonJsrsEmail']) || !empty($invoiceDtls['contactEmail'])) { ?>
                                <span style="color:#333;"><?= !empty($invoiceDtls['contactEmail']) ? $invoiceDtls['contactEmail'] : $invoiceDtls['nonJsrsEmail']; ?></span>
                            <?php } else { ?>
                                <span style="color:#333;">-</span>
                            <?php } ?>
                        </td>
                    </tr>    
                </table>
            </td>
        </tr>
    </table>
    <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
        <tr>
            <td style="padding:0 15px">
                <table style="border:none; width:100%;border-collapse: collapse;margin-top:50px" cellspace="0" cellpadding="0">
                    <thead>
                        <tr style="background: #0070ba;">
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">Classification</th>
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">Description</th>
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">Net Amount</th>
                            <?php if($invoiceDtls['Origin'] == 'N'){ ?>
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">VAT %</th>
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">VAT Amount</th>
                            <?php } ?>
                            <th nowrap style="padding: 10px;color:#fff;font-size:14px;text-align:right;white-space: nowrap">Total Amount</th>            
                        </tr>
                    </thead>
                    <tbody>    
                        <tr>
                            <td valign="top" style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;">
                                <?php
                                if ($invoiceDtls['classification'] == 1) {
                                    echo 'MSME - Micro';
                                } elseif ($invoiceDtls['classification'] == 2) {
                                    echo 'MSME - Small';
                                } elseif ($invoiceDtls['classification'] == 3) {
                                    echo 'MSME - Medium';
                                } elseif ($invoiceDtls['classification'] == 4) {
                                    echo 'Large';
                                } elseif ($invoiceDtls['classification'] == 5) {
                                    echo 'International';
                                } else {
                                    echo '-';
                                }
                                ?></td>
                            <td style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;">
                                <table>
                                    <tr>
                                        <td valign="top" style="color:#666666;font-size:14px"><?= $labelName; ?> Success Fee For:</td>
                                    </tr>
                                    <tr>
                                        <?php if (!empty($invoiceDtls['tenderTitle'])) { ?>
                                            <td valign="top" style="color:#333333"><b>Tender</b>: <?= $invoiceDtls['tenderRef']; ?> - <?= $invoiceDtls['tenderTitle']; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="color:#333333"><b><?= $labelName; ?></b>: <?= $invoiceDtls['contractRef']; ?> - <?= $invoiceDtls['contractTitle']; ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="color:#333333"><b>Awarded By</b>: <?= !empty($invoiceDtls['byCompanyName']) ? $invoiceDtls['byCompanyName'] : '-'; ?></td>
                                    </tr>
                                </table>              
                            </td>
                            <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                                <td valign="top" nowrap style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;">
                                    OMR <?php echo number_format($invoiceDtls['amount'], 3, '.', ''); ?>
                                </td>                                
                            <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                                <td valign="top" nowrap style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;">
                                    USD <?php echo number_format($invoiceDtls['amount'], 2, '.', ''); ?>
                                </td>   
                            <?php } ?>
                            <?php
                            if ($invoiceDtls['Origin'] == 'I') {
                                $vat_percent = (!empty($invoiceDtls['vatPercent'])) ? number_format($invoiceDtls['vatPercent'], 0) : '0';
                                $tot_vat_amt = (!empty($invoiceDtls['vatAamount'])) ? number_format((float) $invoiceDtls['vatAamount'], 2, '.', '') : '0.00';
                            } else {
                                $vat_percent = (!empty($invoiceDtls['vatPercent'])) ? number_format($invoiceDtls['vatPercent'], 0) : '0';
                                $tot_vat_amt = (!empty($invoiceDtls['vatAamount'])) ? number_format((float) $invoiceDtls['vatAamount'], 3, '.', '') : '0.000';
                            }
                            ?>
                            

                            <?php  if ($invoiceDtls['Origin'] == 'N') { ?>
                                <td valign="top" nowrap style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;"><?= $vat_percent ?></td>
                                <td valign="top" nowrap style="padding: 10px;font-size:14px;text-align:left;border-right:1px solid #dadada;" ><?= ($invoiceDtls['Origin'] == 'N' ? 'OMR' : 'USD'); ?> <?= $tot_vat_amt ?></td>
                                <td valign="top" nowrap align="right" style="padding: 10px;font-size:14px;text-align:left;">
                                    OMR <?php echo number_format($invoiceDtls['amount'] + $tot_vat_amt, 3, '.', ''); ?>
                                </td>                                
                            <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                                <td valign="top" nowrap align="right" style="padding: 10px;font-size:14px;text-align:left;">
                                    USD <?php echo number_format($invoiceDtls['amount'] + $tot_vat_amt, 2, '.', ''); ?>
                                </td>   
                            <?php } ?>
                        </tr>
                        <tr>
                            <td colspan="6" style="padding:15px 0;color:#333333;font-size:14px;font-weight:bold;text-align:right;border-top:1px solid #666666">            
                                <table>
                                    <tr>
                                        <td style="color:#333333;font-size:14px;padding-right:50px">Sub Total</td>
                                        <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                                            <td style="color:#333333;font-size:14px" nowrap>
                                                OMR <?php echo number_format($invoiceDtls['amount'], 3, '.', ''); ?>
                                            </td>                                
                                        <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                                            <td style="color:#333333;font-size:14px" nowrap>
                                                USD <?php echo number_format($invoiceDtls['amount'], 2, '.', ''); ?>
                                            </td>   
                                        <?php } ?>
                                    </tr>
                                    <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                                    <tr>
                                        <td style="color:#333333;font-size:14px;padding-right:50px">Vat @ <?= $vat_percent ?>% </td>
                                        <td style="color:#333333;font-size:14px" nowrap><?= ($invoiceDtls['Origin'] == 'N' ? 'OMR' : 'USD'); ?> <?= $tot_vat_amt ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="4" style="background-color:#e0f0ff;padding: 8px 18px 8px 18px;color:#666666;font-size:14px;text-align:left;"> 
                                Amount In Words<span style="color:#333333;">: 
                                    <?php
                                    if ($model_company->MCM_Origin == 'I') {
                                        $amt = number_format($invoiceDtls['amount'] + $tot_vat_amt, 2, '.', '');
                                    } else {
                                        $amt = number_format($invoiceDtls['amount'] + $tot_vat_amt, 3, '.', '');
                                    }
                                    $worddata = common\components\Common::numberToWord($amt, $invoiceDtls['Origin']);
                                    echo strtoupper($worddata);
                                    ?> ONLY</span>
                            </td>
                            <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                                <td colspan="2" style="background-color:#e0f0ff;padding: 8px 18px 8px 18px;color:#333333;font-size:14px;font-weight:bold;text-align:right;" nowrap>
                                    Total OMR <?php echo number_format($invoiceDtls['amount'] + $tot_vat_amt, 3, '.', ''); ?> </td>
                            <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                                <td colspan="2" style="background-color:#e0f0ff;padding: 8px 18px 8px 18px;color:#333333;font-size:14px;font-weight:bold;text-align:right;" nowrap>
                                    Total USD <?php echo number_format($invoiceDtls['amount'] + $tot_vat_amt, 2, '.', ''); ?> </td>
                            <?php } ?>
                        </tr>
                        <tr>            
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
        <tr>
            <td style="padding:15px 15px 15px 15px;">
                <p style="margin-bottom:10px;padding-bottom:10px;font-size:14px;">Payment Terms: <span style="background-color:#3366ff;color:#ffffff;padding:0 5px;display:block">&nbsp;Immediate&nbsp;</span></p> 
                <br><p style="color:#006db7;font-size:15px">Bank Details</p>                                
                <table style="width:100%;border:none;border-collapse: collapse;margin-top:5px;line-height:24px" cellspace="0" cellpadding="0">
                    <tr>				
                        <td style="width:32%;color:#666666;font-size:14px;" valign="top" nowrap>Bank Name</td>
                        <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                            <td style="color:#333;font-size:14px">: Bank Muscat, Oman</td>
                        <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                            <td style="color:#333;font-size:14px">: Bank of Beirut (Al-Ghubrah Branch), Oman</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="width:32%;color:#666666;font-size:14px" valign="top">Account Number</td>
                        <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                            <td style="color:#333;font-size:14px">: A/c No. 0323014650610016</td>
                        <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                            <td style="color:#333;font-size:14px">: USD A/c No. 1140100149500</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="width:32%;color:#666666;font-size:14px;padding-bottom:15px" valign="top">Swift Code</td>
                        <?php if ($invoiceDtls['Origin'] == 'N') { ?>
                            <td style="color:#333;font-size:14px;padding-bottom:15px">: Swift Code - BMUSOMRXXXX</td>
                        <?php } elseif ($invoiceDtls['Origin'] == 'I') { ?>
                            <td style="color:#333;font-size:14px;padding-bottom:15px">: Swift Code - BABEOMRX</td>
                        <?php } ?>
                    </tr> 
                </table>
            </td>    
        </tr>   
    </table>     
    <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
        <tr>
            <td style="padding:15px 15px 15px 15px;">                              
                <table style="width:100%;border:none;border-collapse: collapse;margin-top:5px;line-height:24px" cellspace="0" cellpadding="0"> 
                    <tr>
                        <td colspan="2" style="background-color:#fef5ed;font-size:14px;color:#f4811f;padding:15px 10px 15px 10px">
                            <?php if ($invoiceDtls['Origin'] == "N") { ?>
                                <p>(i) Online Payment: An addition of 2.31% on the <?= $labelName; ?> Success Fee will be added towards Processing Charges</p>
                            <?php } elseif ($invoiceDtls['Origin'] == "I") { ?>
                                <p>(i) Online Payment: An addition of 2.31% on the <?= $labelName; ?> Success Fee will be added towards Processing Charges</p> 
                                <p>(ii) Bank Transfer: For International Suppliers, an addition of USD 25 on the <?= $labelName; ?> Success Fee will be added towards Processing Charges</p> 
                            <?php } ?>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:#333333;font-size:12px;text-align:center;padding-top:20px">                
                            Note: This is a system generated invoice, valid without signature				
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:#333333;font-size:14px;text-align:center;font-weight:bold;padding-top:30px">                         
                            <p style="font-weight:normal">For any enquiry, reach out via email at </p>    
                            accounts@businessgateways.com or call on +968 24166100 | Fax : +968 24170045
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color:#333333;font-size:14px;text-align:center;font-weight:bold;padding-top:30px">                       
                            www.<span style="color:#f48424;">business</span><span  style="color:#0670b9">gateways</span>.com
                        </td>
                    </tr>
                </table>
            </td>    
        </tr>   
    </table>     
</div>   
