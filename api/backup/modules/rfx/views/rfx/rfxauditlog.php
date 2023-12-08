<table style="width:100%;border:none;border-collapse: collapse;line-height:1.5" cellspace="0" cellpadding="0">
    <tr style="background: #f5f6fa;">
     <td style="width:70%;padding:15px 0 15px 15px"><img  alt="jsrsnewlogo.png" src="http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png"></td>
      <td style="padding:15px 15px 15px 1">
        <h2 style="color:#006db7">Audit Log</h2>
     </td>
    </tr>
   </table>
  
  <table style="width:100%;border:none;border-collapse: collapse;margin-top:50px" cellspace="0" cellpadding="0">
    <thead>
        <tr style="background: #f5f6fa;">
            <th nowrap style="width:150px;padding: 10px;color:#006db7;font-size:13px;white-space: nowrap;text-align:left;"> <?= $data['company']; ?> <span style="text-align:right;">Report Generated on: <?= $data['report_generatedon']; ?></span></th>
        </tr>
    </thead>
    <tbody>    
        <tr>
            <td valign="top" style="padding: 10px;font-size:12px;">
                <table>
                    <tr>
                        <td>Ref No. : <?= $data['refno']; ?></td>
                        <td>Notice Type: <?= $data['type']; ?></td>
                    </tr>
                    <tr>
                        <td><?= $data['title']; ?></td>
                    </tr>
                    <tr>
                        <td>Created on : <?= $data['created_on']; ?></td>
                        <td>Created By : <?= $data['created_by']; ?></td>
                        <td>Targeted Suppliers : <?= $data['targeted_suppliers_count']; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Statistics - Targeted Suppliers</td>
        </tr>
        <tr>
            <td>Targeted: <?= $data['statistics']['targeted'] ?></td>
            <td>Opened: <?= $data['statistics']['interested']; ?></td>
            <td>Interested: <?= $data['statistics']['interested']; ?></td>
            <td>Not Interested: <?= $data['statistics']['not_interested']; ?></td>
            <td>Shortlisted: <?= $data['statistics']['shortlisted']; ?></td>
            <td>Rejected: <?= $data['statistics']['rejected']; ?></td>
        </tr>
        <tr>
            <td>Targeted Suppliers (<?= $data['targetedcount'] ?>)</td> 
        </tr>
        <tr>
           
            <td style="padding: 10px;font-size:13px;text-align:center;">
                <table>
                    <tr>
                        <th>Supplier Status</th>
                        <th>Company Name</th>
                        <th>Mail Status</th>
                        <th>Opened</th>
                        <th>Interested</th>
                        <th>Not Interested</th>
                        <th>Shortlisted</th>
                        <th>Rejected</th>
                    </tr>
                    <?php if(!empty($data['targeted_suppliers'])){ 
                    foreach($data['targeted_suppliers'] as $supplier) {
                    ?>
                    <tr>
                        <td><?= $supplier['jsrs_status']; ?></td>
                        <td><?= $supplier['company_name']; ?></td>
                        <td><?= $supplier['mail_status']; ?></td>
                        <td><?= $supplier['opened']; ?></td>
                        <td><?= $supplier['interested']; ?></td>
                        <td><?= $supplier['not_interested']; ?></td>
                        <td><?= $supplier['shortlisted']; ?></td>
                        <td><?= $supplier['rejected']; ?></td>
                    </tr>
                    <?php }
                    }
                    ?>
                </table>              
            </td>
        </tr>
        <tr>            
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
 
   