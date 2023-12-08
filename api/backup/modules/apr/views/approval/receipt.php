<table style="width:100%;border:none;border-collapse: collapse;line-height:1.5" cellspace="0" cellpadding="0">
  <tr style="background: #f5f6fa;">
    <td style="width:70%;padding:15px 0 15px 15px"><img  alt="jsrsnewlogo.png" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png"></td>
    <td style="padding:15px 15px 15px 1">
        <h2 style="color:#006db7">Receipt</h2>
        <p style="color:#666666;font-size:14px">Receipt Reference No<span style="color:#333333">: <?= $receiptDtls['mcpr_receiptno'] ?></span></p>
        <p style="color:#666666;font-size:14px">JSRS Reg. No.<span style="color:#333333">: <?= $receiptDtls['jsrsregno'] ?></span></p>
        <p style="color:#666666;font-size:14px">Receipt Date<span style="color:#333333">: <?= $receiptDtls['receiptdate'] ?></span></p>
    </td>
  </tr>
</table>
<table style="width:100%;border:none;border-collapse: collapse;margin-top:30px;" cellspace="0" cellpadding="0">
  <tr style="background: #fff;">
    <td style="width:50%;padding:15px 0 0 0;" valign="top">
        <h2 style="color: #333333;font-size: 16px;width:100%;padding:0;margin:0">Billed From</h2> <br>
        <img  alt="bgilogonew.png" style="height:80px;margin-bottom:30px" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrs-logo.jpg">   
        <p style="padding-bottom:10px;">Business Gateways International LLC</p>
        <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:24px;" cellspace="0" cellpadding="0">
            <tr>
                <td style="width:20%;color:#666666;font-size:14px" valign="top">Address :</td>
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
       <?php  if(!empty($receiptDtls['companylogo'])){ ?>
        <img  alt="papernotelogonew.png" style="height:80px;margin-bottom:30px" src="<?= $receiptDtls['companylogo'] ?>">
       <?php } ?>
        <p style="padding-bottom:10px;"><?= $receiptDtls['companyName'] ?></p>            
        <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:24px;" cellspace="0" cellpadding="0">
            <?php if($receiptDtls['suppliercode'] && $receiptDtls['jsrsvalsubstatus']=='A') { ?>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px;" valign="top" nowrap>Supplier Code: </td>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['suppliercode'] ?> </td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px;" valign="top" nowrap>JSRS Reg. No.: </td>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['jsrsregno'] ?> </td>
            </tr>
            <?php } ?>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Address: </td>
                <td style="color:#333;font-size:14px"><?=$address ?></td>
            </tr>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Contact Person Name: </td>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['paymentContact']['firstname']; ?> (<?=  $receiptDtls['paymentContact']['designation']; ?>)</td>
            </tr>         
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Mobile:</td>
                   <?php if(!empty( $receiptDtls['paymentContact']['mobileno'])){ ?>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['paymentContact']['mobileDialCode'] . ' ' .  $receiptDtls['paymentContact']['mobileno']; ?></td>
                   <?php } else{ ?>
                       <td style="color:#333;font-size:14px">-</td>
                <?php   } ?>
            </tr>  
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Email ID:</td>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['paymentContact']['emailid']; ?></td>
            </tr>    
        </table>
    </td>
  </tr>
</table>
<table style="width:100%;border:none;border-collapse: collapse;margin-top:50px" cellspace="0" cellpadding="0">
    <thead>
        <tr style="background: #0070ba;">
            <th style="width:20%;padding: 10px 18px 10px 18px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">Classification</th>
            <th style="width:60%;padding: 10px 18px 10px 18px;color:#fff;font-size:14px;text-align:left;white-space: nowrap">Description</th>
            <th style="padding: 10px 18px 10px 18px;color:#fff;font-size:14px;text-align:right;white-space: nowrap">Amount</th>            
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td style="padding: 10px 18px 10px 18px;font-size:14px;text-align:left">JSRS OMAN: <?= $receiptDtls['classicationType']; ?></td>
            <td style="padding: 10px 18px 10px 18px;font-size:14px;text-align:left">
                <table>
                    <tr>
                        <td style="color:#666666;font-size:14px">Subscription Type</td>
                        <?php if($isRenewal){ ?>
                        <td style="color:#333333">: JSRS Certification Fee (Renewal)</td>
                        <?php } else { ?>
                        <td style="color:#333333">: JSRS Certification Fee (Fresh)</td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="color:#666666;font-size:14px">Pack</td>
                        <td style="color:#333333">:  <?= (!empty($receiptDtls['subscription']['packageName']) ? $receiptDtls['subscription']['packageName'] : 'NIL'); ?></td>
                    </tr>
                    <tr>
                        <td style="color:#666666;font-size:14px">Subscription Period</td>
                        <td style="color:#333333">: <?= (!empty($receiptDtls['subscription']['duration']['Years']) ? $receiptDtls['subscription']['duration']['Years'] : 'NIL'); ?>  Year(s)</td>
                    </tr>
                </table>              
            </td>
            <td nowrap align="right"><?= (!empty($receiptDtls['subscription']['packageBaseCurrencySymbol']) ? $receiptDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>  <?= (!empty($baseprice) ? $baseprice : '-'); ?></td>
        </tr>
        <tr>
            <td colspan="3" style="padding:15px 0;color:#333333;font-size:14px;font-weight:bold;text-align:right;border-top:1px solid #666666">            
                <table>
                        <tr>
                            <td style="color:#333333;font-size:14px;padding-right:50px">Sub Total</td>
                            <td style="color:#333333" nowrap><?= (!empty($receiptDtls['subscription']['packageBaseCurrencySymbol']) ? $receiptDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>  <?= (!empty($baseprice) ? $baseprice : '-'); ?></td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:14px;padding-right:50px">Vat @ <?= $vatper ?>% </td>
                            <td style="color:#333333" nowrap><?= (!empty($receiptDtls['subscription']['packageBaseCurrencySymbol']) ? $receiptDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>  <?= (!empty($vatprice) ? $vatprice : '-'); ?></td>
                        </tr>
                </table>
            </td>
        </tr>   
        <tr>
            <td colspan="2" style="background-color:#e0f0ff;padding: 8px 18px 8px 18px;color:#666666;font-size:14px;text-align:left;"> 
				Amount In Words<span style="color:#333333;">: <?php echo strtoupper($amtintowords); ?> ONLY</span>
            </td>
            <td style="background-color:#e0f0ff;padding: 8px 18px 8px 18px;color:#333333;font-size:14px;font-weight:bold;text-align:right;" nowrap>
                Total   <?= (!empty($receiptDtls['subscription']['packageBaseCurrencySymbol']) ? $receiptDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>  <?= (!empty($totalprice) ? $totalprice : '-'); ?>
            </td>
        </tr>
        <tr>            
    </tbody>
</table>
<table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
    <tr>
        <td style="padding:15px 15px 15px 15px;">
        <p style="margin-bottom:10px;font-size:14px;">Payment Terms: <span style="background-color:#3366ff;color:#ffffff">Immediate</span></p> 
        <p style="color:#006db7;font-size:15px">Bank Details</p>                                
        <table style="width:100%;border:none;border-collapse: collapse;margin-top:15px;line-height:24px" cellspace="0" cellpadding="0">
            <tr>				
                <td style="width:32%;color:#666666;font-size:14px;" valign="top" nowrap>Bank Name</td>
                <?php if ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'OMR') { ?>
                <td style="color:#333;font-size:14px">: Bank Muscat, Oman</td>
                <?php } elseif ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'USD') { ?>
                <td style="color:#333;font-size:14px">: Bank of Beirut (Al-Ghubrah Branch), Oman</td>
                <?php } ?>
            </tr>
            <tr>
                <td style="width:32%;color:#666666;font-size:14px" valign="top">Account Number</td>
                <?php if ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'OMR') { ?>
                <td style="color:#333;font-size:14px">: A/c No. 0323014650610016</td>
                <?php } elseif ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'USD') { ?>
                <td style="color:#333;font-size:14px">: USD A/c No. 1140100149500</td>
                <?php } ?>
            </tr>
            <tr>
                <td style="width:32%;color:#666666;font-size:14px;padding-bottom:15px" valign="top">Swift Code</td>
                <?php if ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'OMR') { ?>
                <td style="color:#333;font-size:14px;padding-bottom:15px">: BMUSOMRXXXX</td>
                <?php } elseif ($receiptDtls['subscription']['packageBaseCurrencySymbol'] == 'USD') { ?>
                <td style="color:#333;font-size:14px;padding-bottom:15px">: BABEOMRX</td>
                <?php } ?>
            </tr> 
            <tr>
                <td colspan="2" style="background-color:#fef5ed;font-size:13px;color:#f4811f;padding:15px 10px 15px 10px">
                    <p >(i) Online Payment: An addition of 2.31% on the Certification Fee will be added towards processing charges.</p>
                    <?php if($receiptDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>
                    <p >(ii) Bank Transfer: For International suppliers, An addition of USD 25 on the Certification Fee will be added towards processing charges.</p>
                    <?php } ?>
                    <p ><?php if($receiptDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>(iii) <?php }else{ ?> (ii) <?php } ?> The amount invoiced is based on the company classification chosen by the supplier and is subject to change if any discrepancy is noticed in the classification as part of the validation process.</p>
                    
                </td>
            </tr>
            <tr>
                <td colspan="2" style="color:#333333;font-size:12px;text-align:center;padding-top:20px">                
					Note: This is a system generated receipt, valid without signature				
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
   