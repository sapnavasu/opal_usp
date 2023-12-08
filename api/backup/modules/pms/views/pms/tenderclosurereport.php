<table style="width:100%;border:none;border-collapse: collapse;line-height:1.5" cellspace="0" cellpadding="0">
    <tr style="background: #f5f6fa;">
     <td style="width:70%;padding:15px 0 15px 15px"><img  alt="jsrsnewlogo.png" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png"></td>
      <td style="padding:15px 15px 15px 1">
        <h2 style="color:#006db7">Tender Closure Report</h2>
     </td>
    </tr>
   </table>
  
  <table style="width:100%;border:none;border-collapse: collapse;margin-top:50px" cellspace="0" cellpadding="0">
    <thead>
        <tr style="background: #f5f6fa;">
            <th><?= $data['companyName']; ?></th>
            <th nowrap style="width:150px;padding: 10px;color:#006db7;font-size:13px;white-space: nowrap;text-align:left;"> <?= $data['company']; ?> <span style="text-align:right;">Downloaded Date & Time : <?= $data['generatedon']; ?></span>
            <span style="text-align:right;">Downloadeded By : <?= $data['generatedby']; ?></span>
        </th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td valign="top" style="padding: 10px;font-size:12px;">
                <table>
                    <tr>
                        <td>Tender Id: <?= $data['requisition']['id']; ?></td>
                        <td>Tender Ref No. <?= $data['requisition']['refno']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $data['requisition']['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Status : <?= $data['requisition']['status']; ?></td>
                    </tr>
                    <tr>
                        <td>Tender Process Type : <?= $data['requisition']['process_type']; ?></td>
                        <td>Tender Notice Type : <?= $data['requisition']['notice_type']; ?></td>
                        <td>Date of Tender Notice : <?= $data['requisition']['tender_date']; ?></td>
                        <td>Priority : <?= $data['requisition']['priority']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" style="padding: 10px;font-size:12px;">
                <table>
                    <tr>
                        <td>Project Id: <?= $data['project']['id']; ?></td>
                        <td>Project Ref No. <?= $data['project']['refno']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $data['project']['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Status : <?= $data['project']['status']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Total Enquiries</td>
        </tr>
        <tr>
            <?php if(!empty($data['total_tenders'])){ 
                foreach($data['total_tenders'] as $key => $val){
                ?>
                <td><?= $key; ?>: <?= $val; ?></td>
                <?php } 
            }
            ?>
        </tr>
        <tr>
            <td>Bidder Activity</td> 
        </tr>
        <?php if(!empty($data['tenderRfx']['rfxdata'])){ 
            foreach($data['tenderRfx']['rfxdata'] as $val){
        ?>
        <tr>
            <td valign="top" style="padding: 10px;font-size:12px;">
                <table>
                    <tr>
                        <td><?= $val['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Ref No. : <?= $val['refno']; ?></td>
                        <td>Date of publish <?= $val['publish_date']; ?></td>
                    </tr>
                  
                    <tr>
                        <td>Closing Date & Time : <?= $val['closing_date']; ?></td>
                    </tr>
                    <tr>
                        <td>Targeted: <?= $val['bidders_invited'] ?></td>
                        <td>Interested: <?= $val['bidders_interested']; ?></td>
                        <td>Not Interested: <?= $val['bidders_not_interested']; ?></td>
                        <td>Shortlisted: <?= $val['bidders_shortlisted']; ?></td>
                        <td>Rejected: <?= $val['bidders_rejected']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php } } ?>
        <tr>
            <td>Contract Awards</td>
        </tr>
        <?php if(!empty($data['tenderRfx']['contract_awards'])){ 
            foreach($data['tenderRfx']['contract_awards'] as $val){
        ?>
        <tr>
            <td valign="top" style="padding: 10px;font-size:12px;">
                <table>
                    <tr>
                        <td><?= $val['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Contract Id : <?= $val['contract_id']; ?></td>
                        <td>Contract Ref No. <?= $val['contract_refno']; ?></td>
                    </tr>
                    <tr>
                        <td> <?= $val['contract_title']; ?></td>
                    </tr>
                    <tr>
                        <td> Status : <?= $val['sttaus']; ?></td>
                        <td> Obligation : <?= $val['obligation']; ?></td>
                    </tr>
                   
                    <tr>
           
           <td style="padding: 10px;font-size:13px;text-align:center;">
               <table>
                   <tr>
                       <th>JSRS Supplier Code</th>
                       <th>Company Name</th>
                       <th>Country</th>
                       <th>Special Status</th>
                       <th>Classification</th>
                       <th>JSRS Status</th>
                       <th>Awarded On</th>
                   </tr>
                   <?php if(!empty($val['awarded'])){ 
                   foreach($data['awarded'] as $award) {
                   ?>
                   <tr>
                       <td><?= $award['jsrs_supplier_code']; ?></td>
                       <td><?= $award['company']; ?></td>
                       <td><?= $award['country']; ?></td>
                       <td><?= $award['classification']; ?></td>
                       <td><?= $award['jsrs_status']; ?></td>
                       <td><?= $award['awarded_on']; ?></td>
                   </tr>
                   <?php }
                   }
                   ?>
               </table>              
           </td>
       </tr>
                </table>
            </td>
        </tr>
        <?php } } ?>           
      </tbody>
    </table>
    <table style="width:100%;border:none;border-collapse: collapse;" cellspace="0" cellpadding="0">
        <tr>
            <td colspan="2" style="color:#333333;font-size:14px;text-align:center;font-weight:bold;padding-top:30px">                       
                www.<span style="color:#f48424;">business</span><span  style="color:#0670b9">gateways</span>.com
            </td>
        </tr>
        </table>
        </td>    
    </tr>   
    </table>
 
   