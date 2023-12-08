<div  style="padding:40px; ">
    <div style="border: 0px">
        <table style="width:100%;border:none;border-collapse: collapse;line-height:20px;" cellspace="0" cellpadding="0">
            <tr style="background: #ebebec;" data-mce-style="#ebebec;">
                <td style="padding:20px 0 20px 15px;" valign="top"><img style="height:130px" alt="rabt_logo" src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/dev/src/assets/images/rabt-logo-1.svg"></td>
                <td style="padding:10px 15px 10px 15px" align="right" valign="top">
                    <table>
                        <?php if($taxinvoice==1){ ?>
                            <tr><td nowrap align="left" valign="top" style="color:#006db7;font-size: 24px;font-weight: bold;">Tax Invoice</td></tr>
                            <tr><td nowrap align="left" valign="top" style="color:#58626e;font-size: 24px;font-weight: bold;" ></td></tr>
                            <tr><td nowrap align="left" valign="top" style="color:#666666;font-size:13px;white-space: nowrap" nowrap>Tax Invoice Reference No.<span style="color:#333333;white-space: nowrap" nowrap>: <?= $invoiceDtls['taxInvoiceRefNo'] ?></span></td></tr>
                            <tr><td nowrap align="left" valign="top" style="color:#666666;font-size:13px;white-space: nowrap" nowrap>Tax Invoice Date<span style="color:#333333;white-space: nowrap" nowrap>: <?= date('d-m-Y'); ?></span></td></tr>
                        <?php }else{ ?>
                            <tr><td nowrap align="left" valign="top" style="padding-bottom:10px;color:#58626e;font-size: 24px;font-weight: bold;" >Proforma Invoice</td></tr>
                            <tr><td nowrap align="left" valign="top" style="color:#58626e;font-size: 24px;font-weight: bold;" ></td></tr>
                            <tr><td nowrap align="left" valign="top" style="padding-bottom:10px;color:#666666;font-size:13px;white-space: nowrap;" nowrap>Proforma Invoice Reference No.<span style="color:#333333;white-space: nowrap" nowrap>: <?= $invoiceDtls['invoiceRefNo'] ?></span></td></tr>
                            <tr><td nowrap align="left" valign="top" style="padding-bottom:10px;color:#666666;font-size:13px;white-space: nowrap;" nowrap>Proforma Invoice Date<span style="color:#333333;white-space: nowrap" nowrap>: <?= $invoiceDtls['invoiceDate'] ?></span></td></tr>
                            <tr><td nowrap align="left" valign="top" style="padding-bottom:10px;color:#666666;font-size:13px;white-space: nowrap" nowrap>Delivery Date<span style="color:#333333;white-space: nowrap" nowrap>: <?= $invoiceDtls['invoiceDate'] ?></span></td></tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
        </table>

        <table style="width:100%;border:none;border-collapse: collapse;margin-top:30px;line-height:20px" cellspace="0" cellpadding="0">
            <tr>
                <td style="width:55%;padding:15px 15px 0 15px;" valign="top">
                    <h2 style="color: #333333;font-size: 15px;width:100%;padding:0;margin:0">Billed From</h2> <br>
                    <img  alt="IIA-logo" style="height:65px;margin-bottom:30px" src="<?php echo \Yii::$app->params['backendBaseUrl']; ?>/dev/src/assets/images/IIA-logo.svg">   
                    <p style="padding-bottom:10px;font-size: 15px;">Industrial Innovation Academy (IIA)</p>
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:60px;" valign="top">Address : </td>
                            <td><p style="color:#333;font-size:13px;">124, 65, Rusayl Industrial City, AI Rusail, AI Seeb Muscat, Sultanate of Oman</p></td>
                        </tr>
                    </table>
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:37px" valign="top">C.R. :</td>
                            <td>
                                <p style="color:#333;font-size:13px;">1300341</p>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:50px" valign="top">VATIN :</td>
                            <td>
                                <p style="color:#333;font-size:13px;">OM1100030649</p>
                            </td>
                        </tr>
                    </table>
                </td> 
                <td style="width:45%;padding:15px 0 0 15px;" valign="top">
                    <h2 style="color: #333333;font-size: 16px;width:100%;padding:0;margin:0">Billed To</h2><br>
                    <?php  if(!empty($invoiceDtls['companylogo'])){ ?>
                        <img  alt="papernotelogonew.png" style="height:65px;margin-bottom:30px" src="<?= $invoiceDtls['companylogo'] ?>">
                    <?php } ?>
                    <p style="padding-bottom:10px;font-size: 15px;text-transform:capitalize"><?= $invoiceDtls['companyName'] ?></p>            
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:10px;line-height:20px;" cellspace="0" cellpadding="0">
                        <?php if($invoiceDtls['jsrsvalsubstatus']=='A') { ?>
                            <tr>
                                <td style="color:#666666;font-size:13px;width:75px" valign="top">RABT Code : </td>
                                <td>
                                    <p style="color:#333;font-size:13px;"><?= $invoiceDtls['rabtcode'] ?></p>
                                </td>             
                            </tr>
                        <?php }else{ ?>
                            <tr>
                                <td style="color:#666666;font-size:13px;width:98px" valign="top">RABT Reg. No. : </td>
                                <td>
                                    <p style="color:#333;font-size:13px;"><?= $invoiceDtls['rabtregno'] ?></p>
                                </td>   
                            </tr>
                        <?php } ?>
                    </table>
                        
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:6px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:60px" valign="top">Address : </td>
                            <td>
                                <p style="color:#333;font-size:13px;">Falaj, Al Qubail, Sohar, PC 322, Muscat</p>
                            </td>
                        </tr>
                    </table>
                        
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:6px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td nowrap align="left" valign="top" style="padding-bottom:10px;color:#666666;font-size:13px;white-space: nowrap;width:55px" nowrap>
                                VATIN<span style="color:#333333;white-space: nowrap" nowrap> : 
                                    <?php if($invoiceDtls['origin_type']=='N'){ 
                                        if(!empty($invoiceDtls['vatinno']) && $invoiceDtls['vatinno']!='NULL'){
                                            echo $invoiceDtls['vatinno']; 
                                        }else{ 
                                            echo "Not available"; 
                                        }
                                    }else{ 
                                        echo "Not applicable"; } ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:6px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="line-height:26px;">
                                <p style="color:#333;font-size:15px;"><b><?= $invoiceDtls['paymentContact']['firstname'] ?> <?= $invoiceDtls['paymentContact']['middlename'] ?>  <?= $invoiceDtls['paymentContact']['lastname'] ?> (<?= $invoiceDtls['paymentContact']['designation'] ?>)</span></b></p>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:6px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:50px" valign="top">Mobile : </td>
                            <td>
                                <p style="color:#333;font-size:13px;">(<?= $invoiceDtls['paymentContact']['mobileDialCode'] ?>) <?= $invoiceDtls['paymentContact']['mobileno'] ?></p>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:6px;line-height:20px;" cellspace="0" cellpadding="0">
                        <tr>
                            <td style="color:#666666;font-size:13px;width:60px" valign="top">Email ID :  </td>
                            <td>
                                <p style="color:#333;font-size:13px;"> <?= $invoiceDtls['paymentContact']['emailid'] ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
            <tr>
                <td style="padding:0 15px;">
                    <table style="border:none; width:100%;border-collapse: collapse;margin-top:30px" cellspace="0" cellpadding="0">
                        <thead>
                            <tr style="background: #58626E;">
                                <th nowrap style="width:200px;padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Classification</th>
                                <th nowrap style="width:500px;padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Description</th>
                                <th nowrap style="padding: 10px;color:#fff;font-size:13px;text-align:left;white-space: nowrap">Net Amount</th>            
                            </tr>
                        </thead>
                        <tbody>    
                            <tr>
                                <td valign="middle" style="padding: 10px;font-size:13px;text-align:left;border-right:1px solid #dadada;border-bottom:1px solid #dadada;text-align:left;color:#666666;"> <span><?= $invoiceDtls['classicationType'] ?></span></td>
                                <td style="padding: 10px;font-size:13px;text-align:left;border-right:1px solid #dadada;border-bottom:1px solid #dadada;">
                                    <table>
                                        <tr>
                                            <td valign="top" style="color:#666666;font-size:15px;"> Subscription Type: </td>
                                            <?php if($isRenewal){ ?>
                                            <td valign="top" style="color:#333333;font-size:15px;"> RABT Industrial Organization Certification Fee </td>
                                            <?php } else { ?>
                                            <td valign="top" style="color:#333333;font-size:15px;"> RABT Supply Chain Certification Fee </td>
                                            <?php } ?>
                                        </tr>
                                    <tr>
                                            <td valign="top" style="color:#666666;font-size:15px;">Validity Period: </td>
                                            <td valign="top" style="color:#333333;font-size:15px;"><?= (!empty($invoiceDtls['subscription']['duration']['Years']) ? $invoiceDtls['subscription']['duration']['Years'] : 'NIL'); ?> Year</td>
                                        </tr>
                                    </table>              
                                </td>
                                <td style="padding: 10px;font-size:13px;text-align:right;border-bottom:1px solid #dadada;">
                                    <table>
                                        <tr>
                                            <td valign="top" style="color:#666666;font-size:15px;text-align: center;"><?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?></td>
                                            <td valign="top" style="color:#666666;font-size:15px;text-align: center;"><?= (!empty($baseprice) ? $baseprice : '-'); ?></td>
                                        </tr>
                                    </table>              
                                </td>      
                            </td>
                            </tr>
                                
                        </tbody>
                    </table>

                    <table style="border:none; width:100%;border-collapse: collapse;">
                        <?php  if(\Yii::$app->params['discoutapplicable'])   
                            { 
                        ?>
                        <tr>
                            <td width="85%" style="color:#666666;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:20px"> 
                                Special Discount <?= $invoiceDtls['subscription']['discountper'] ?>%&nbsp;:&nbsp;
                            </td>
                            <td width="15%" style="color:#333333;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:20px;text-align:right;"> 
                                <?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>
                                <span style="color:#333333;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:20px"> - <?= $invoiceDtls['subscription']['discountval'] ?></span>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php  if(\Yii::$app->params['discoutapplicable'])   
                            { ?>
                        <tr>
                            <td width="85%" style="color:#666666;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:15px"> 
                                Promo Code Discount <?= (int)$promodtls['pcm_discpercent'] ?>%&nbsp;:&nbsp;
                            </td>
                            <td width="15%" style="color:#333333;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:15px;text-align:right;"> 
                            <?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>
                            <span style="color:#333333;font-size:15px;padding-bottom:12px;font-weight:normal;padding-top:15px"> - <?= $prmodiscamount ?></span>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if(!empty($vatper)) { ?>
                        <tr>
                            <td width="86%" style="color:#666666;font-size:15px;padding-bottom:15px;font-weight:normal;padding-top:15px;text-align:right;padding-left:0px;"> 
                                VAT <?= (!empty($vatper) ? $vatper : '0'); ?>%&nbsp;:&nbsp;
                            </td>
                            <td width="14%" style="color:#333333;font-size:15px;padding-bottom:15px;padding-top:15px;text-align:right;padding-right: 14px;"> 
                                <?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?>
                                <span style="color:#333333;font-size:15px;padding-bottom:15px;padding-top:5px">+ <?= (!empty($vatprice) ? $vatprice : '-'); ?></span>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
                    <table style="border:none; width:100%;border-collapse: collapse;">
                        <tr>
                            <td width= "60%" style="background-color:#ececec;padding: 8px 10px 8px 8px;color:#666666;font-size:15px;text-align:left;"> 
                                Amount In Words: <span style="color:#333333;">   <?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?> <?= strtoupper($amtintowords) ?> ONLY</span>
                            </td>
                            <td width= "40%" style="background-color:#ececec;padding: 8px 0px 8px 18px;color:#333333;font-size:15px;padding-left:15px;text-align:right;padding-right: 4px;">
                                <table style="border:none; width:100%;border-collapse: collapse;">
                                    <tr>
                                        <td style="background-color:#ececec;padding: 8px 8px 8px 32px;color:#333333;font-size:15px;text-align:right;padding-left:85px;font-weight:600;">
                                            Total Amount
                                        </td style="text-align:right;">
                                        <td>
                                            <span style="color:#333333;font-weight:600;"><?= (!empty($invoiceDtls['subscription']['packageBaseCurrencySymbol']) ? $invoiceDtls['subscription']['packageBaseCurrencySymbol'] : ' '); ?> <?= (!empty($totalprice) ? number_format($totalprice,3) : '-'); ?></span> &nbsp; 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
            <tr>
                <td style="padding:15px 15px 15px 15px;">
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:5px;line-height:20px; margin-top:10px" cellspace="0" cellpadding="0">
                        <tr>
                            <td>
                                <p style="margin-bottom:10px;padding-bottom:10px;font-size:15px;color:#666666;">Payment Terms: &nbsp;&nbsp;<span style="background-color:#4AA1AC;color:#ffffff;padding:0 5px;display:block">&nbsp;Immediate&nbsp;</span></p> 
                            </td>
                        </tr>
                    </table>
                    <!-- <br><p style="color:#58626e;font-size:15px">Bank Details</p>                                 -->
                    <table style="width:100%;border:none;border-collapse: collapse;margin-top:5px;line-height:20px; margin-top:40px" cellspace="0" cellpadding="0">
                        <!-- <tr>				
                            <td style="width:32%;color:#666666;font-size:13px;" valign="top" nowrap>Beneficiary Name: 
                                <span style="color:#333;font-size:13px;"> Business Gateways International LLC</span>
                            </td>           
                        </tr>
                        <tr>				
                            <td style="width:32%;color:#666666;font-size:13px;" valign="top" nowrap>Bank Name: 
                                <?php if($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="OMR"){ ?>
                                <span style="color:#333;font-size:13px;">Bank Muscat, Oman</span>
                                <?php }elseif($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>
                                <span style="color:#333;font-size:13px;">Bank of Beirut (Al-Ghubrah Branch), Oman</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:32%;color:#666666;font-size:13px;" valign="top">Account Number:
                                <?php if($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="OMR"){ ?>
                                <span style="color:#333;font-size:13px;">A/c No. 0323014650610016</span>
                                <?php }elseif($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>
                                <span style="color:#333;font-size:13px;">USD A/c No. 1140100149500</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:32%;color:#666666;font-size:13px;padding-bottom:15px" valign="top">Swift Code: 
                                <?php if($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="OMR"){ ?>
                                <span style="color:#333;font-size:13px;padding-bottom:15px"> BMUSOMRXXXX</span>
                                <?php }elseif($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>
                                <span style="color:#333;font-size:13px;padding-bottom:15px"> BABEOMRX</span>
                                <?php } ?>
                            </td>                
                        </tr> -->
                        <tr>
                            <td  style="background-color:#fef5ed;font-size:13px;color:#f4811f;padding:15px 10px 15px 10px;">
                                <p >(i) Online Payment: An addition of 
                                    <?= ($invoiceDtls['origin_type']=='N')? \Yii::$app->params['additional_processing_charge']: \Yii::$app->params['additional_processing_charge_international']?>% 
                                    on the Certification Fee will be added towards processing charges.
                                </p>
                                <?php if($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>
                                <p >(ii) The amount invoiced is based on the company classification criteria entered by the supplier and is subject to change if any discrepancy is noticed in
                                    the classification as part of the validation process.</p>
                                <?php } ?>
                                <p ><?php if($invoiceDtls['subscription']['packageBaseCurrencySymbol']=="USD"){ ?>(iii) <?php }else{ ?> (ii) <?php } ?> 
                                    The amount invoiced is based on the company classification criteria entered by the supplier and is subject to change 
                                    if any discrepancy is noticed in the classification as part of the validation process.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:14px;text-align:center;padding-top:20px;">                
                                Note: This is a system generated invoice, valid without signature				
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:15px;text-align:center;padding-top:20px;">                         
                                <p style="font-weight:normal">For any enquiry, reach out via email us at </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:15px;text-align:center;padding-top:10px;">                       
                                accounts@rabt.om or call on +968 24 166 177
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#333333;font-size:18px;text-align:center;font-weight:bold;padding-top:20px;">                       
                                <a class="rabtlink" href="https://qa.rabt.om/" target="_blank">
                                    www.<span style="color:#f48424;font-size:18px;">rabt</span>.om
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>    
            </tr>   
        </table>     
    </div>   

</div>