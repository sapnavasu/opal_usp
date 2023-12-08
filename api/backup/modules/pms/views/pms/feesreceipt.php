<table style="width:100%;border:none;border-collapse: collapse;line-height:1.5" cellspace="0" cellpadding="0">
    <tr style="background: #f5f6fa;">
     <td style="width:70%;padding:15px 0 15px 15px"><img  alt="jsrsnewlogo.png" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png"></td>
      <td style="padding:15px 15px 15px 1">
        <h2 style="color:#006db7">Receipt</h2>
        <p style="color:#666666;font-size:14px">Receipt No<span style="color:#333333">: <?= $receiptDtls['mcpr_receiptno'] ?></span></p>
        <p style="color:#666666;font-size:14px">Receipt Date<span style="color:#333333">: <?= $receiptDtls['receiptdate'] ?></span></p>
     </td>
    </tr>
   </table>
  <table style="width:100%;border:none;border-collapse: collapse;margin-top:30px;" cellspace="0" cellpadding="0">
  <tr style="background: #fff;">
    <td style="width:50%;padding:15px 0 0 0;" valign="top">
        <h2 style="color: #333333;font-size: 16px;width:100%;padding:0;margin:0">Billed From</h2> <br>
        <img  alt="bgilogonew.png" style="height:80px;margin-bottom:30px" src="http://bgi.businessgateways.net/j3/app/assets/images/bgilogonew.png">   
        <p style="padding-bottom:10px;">Business Gateways International LLC</p>
        <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:24px;" cellspace="0" cellpadding="0">
            <tr>
                <td style="width:20%;color:#666666;font-size:14px;padding-bottom:15px;" valign="top">Address:</td>
                <td style="padding-bottom:15px;">
                <p style="color:#333;font-size:13px">Sultanate of Oman, Muscat, Al Seeb, </p>
                    <p style="color:#333;font-size:13px"> Knowledge Oasis Muscat, 130, 1491</p>
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
            <?php if($receiptDtls['suppliercode']) { ?>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px;" valign="top" nowrap>Supplier Code:</td>
                <td style="color:#333;font-size:14px"><?= $receiptDtls['suppliercode'] ?> </td>
            </tr>
            <?php } ?>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Address:</td>
                        <td style="color:#333;font-size:14px"><?=$address ?></td>
            </tr>
            <tr>
                <td style="width:35%;color:#666666;font-size:14px" valign="top">Contact Person Name: </td>
                <td style="color:#333;font-size:14px;padding-top:15px;"><?= $receiptDtls['paymentContact']['firstname']; ?> (<?=  $receiptDtls['paymentContact']['designation']; ?>)</td>
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
            <th nowrap style="width:150px;padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Invoice No.</th>
            <th nowrap style="width:450px;padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Description</th>
            <th nowrap style="padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Invoice Amount</th>
            <th nowrap  style="padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Received Amount</th>           
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td valign="top" style="padding: 10px;font-size:13px;text-align:left;"><?= $receiptDtls['invoiceno']; ?></td>
            <td style="padding: 10px;font-size:13px;text-align:left;">
                <table>
                     <tr>
                        <td style="color:#666666;font-size:14px;width:170px;">Contract Success Fee For</td>
                    </tr>
                    <?php if(!empty($receiptDtls['tenderTitle'])){ ?>
                        <tr>
                            <td style="color:#666666;font-size:14px">Tender:</td>
                            <td style="color:#333333"> <?= $receiptDtls['tenderTitle']; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td style="color:#666666;font-size:14px">Contract:</td>
                        <td style="color:#333333"> <?= $receiptDtls['contTitle']; ?></td>
                    </tr>
                    <tr>
                        <td style="color:#666666;font-size:14px">Awarded By:</td>
                        <td style="color:#333333"> <?= $receiptDtls['awadedby']; ?></td>
                    </tr>
                </table>              
            </td>
            <td valign="top" nowrap style="padding: 10px;font-size:13px;text-align:left;"> <?= $receiptDtls['Rcurrencysymbol']; ?> <?= $invoiceamt; ?></td>
            <td valign="top"  style="padding: 10p 15px 10px 10px;font-size:13px;"> <?= $receiptDtls['Rcurrencysymbol']; ?> <?= $receivedamt; ?></td>
        </tr>
        <tr>
            <td colspan="4" style="padding:15px 0;color:#333333;font-size:14px;font-weight:bold;text-align:right;border-top:1px solid #666666">   
                <table>
                        <tr>
                            <td style="color:#333333;font-size:14px;padding-right:50px">Sub Total</td>
                            <td style="color:#333333" nowrap><?= $receiptDtls['Rcurrencysymbol']; ?>  <?= $invoiceamt; ?></td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:14px;padding-right:50px">Vat @ <?= $receiptDtls['vatpercent'] ?>% </td>
                            <td style="color:#333333" nowrap><?= $receiptDtls['Rcurrencysymbol']; ?>  <?= $receiptDtls['vatamt']; ?></td>
                        </tr>
                </table>
            </td>
        </tr>
<!--        <tr>
            <td colspan="3" style="padding:15px 0;color:#333333;font-size:14px;font-weight:bold;text-align:right;border-top:1px solid #666666">            
                <table>
                        <tr>
                            <td style="color:#333333;font-size:14px;padding-right:50px">Total</td>
                            <td style="color:#333333" nowra
                        </tr>
                </table>
            </td>
        </tr>   -->
        <tr>
            <td colspan="3" style="background-color:#e0f0ff;padding: 15px 18px 15px 18px;color:#666666;font-size:13px;text-align:left;"> 
				Amount In Words<span style="color:#333333;">: <?php echo strtoupper($amtintowords); ?> ONLY</span>
            </td>
            <td colspan="1" style="background-color:#e0f0ff;padding: 15px 15px 15px 18px;color:#333333;font-size:13px;font-weight:bold;text-align:right;" nowrap>
                Total   <?=$receiptDtls['Rcurrencysymbol']; ?>  <?= $receivedamt; ?>
            </td>
          </tr>
          <tr>            
      </tbody>
    </table>
    <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
      <tr>
        <td style="padding:15px 15px 8px 15px;">
        <p style="font-size:14px;color:#666;">Payment Mode: <span style="background-color:#ff6600;color:#ffffff;padding:0 5px;display:block">&nbsp;<?=$receiptDtls['paymentmode']; ?>&nbsp;</span></p> 
       <tr>
           <td style="margin-top:6px;padding-left:15px;">
            <p style="margin-top:0px;padding-top:0px;font-size:14px;color:#666;">Payment Reference: <span style="color:#333;padding:0 5px;display:block">&nbsp;<?=$receiptDtls['referenceno']; ?>&nbsp;</span></p>                                
           </td >
       </tr>
         <p style="margin-bottom:10px;font-size:14px;">Payment Terms: <span style="background-color:#3366ff;color:#ffffff">Immediate</span></p>  
         <p style="color:#006db7;font-size:15px">Bank Details</p>                                 
        <table style="width:100%;border:none;border-collapse: collapse;margin-top:15px;line-height:24px" cellspace="0" cellpadding="0">
             <tr>				
                <td style="width:32%;color:#666666;font-size:14px;" valign="top" nowrap>Bank Name</td>
                <td style="color:#333;font-size:14px">: Bank of Beirut (Al-Ghubrah Branch), Oman</td>
            </tr>
            <tr>
                <td style="width:32%;color:#666666;font-size:14px" valign="top">Account Number</td>
                <td style="color:#333;font-size:14px">: USD A/c No. 1140100149500</td>
            </tr>
            <tr>
                <td style="width:32%;color:#666666;font-size:14px;padding-bottom:15px" valign="top">Swift Code</td>
                <td style="color:#333;font-size:14px;padding-bottom:15px">: Swift Code - BABEOMRX</td>
            </tr> 
            <tr>
                <td colspan="2" style="background-color:#fef5ed;font-size:14px;color:#f4811f;padding:15px 10px 15px 10px">
                    <?php if($receiptDtls['Rcurrencysymbol']=='OMR'){ ?>
                    <p >(i) Online Payment: An addition of 2.31% on the Contract Success Fee will be added towards Processing Charges</p>
                    <?php }else{ ?>
                    <p >(i) Online Payment: An addition of 2.31% on the Contract Success Fee will be added towards Processing Charges</p>
                    <p>(ii) Bank Transfer: For International Suppliers, an addition of USD 25 on the Contract Success Fee will be added towards Processing Charges</p>
                    <?php } ?>
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
 
   