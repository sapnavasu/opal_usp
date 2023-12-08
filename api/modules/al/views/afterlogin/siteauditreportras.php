<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.shadow-cell {
    padding: 10px 15px;
    border: 1px solid #f4f6f9;
    background-color: #ffffff;
    position: relative;
}
.horizontal-line {
    color: #ED1C27;
    width: 80%; 
    background-color: #f0f0f0;
    padding: 5px;
    
}

</style>
<div style=" background-color: #ffffff;padding: 5px 5px;width: 100%;">
<!-- 1 . Organisation Details -->
  <table style="table-layout: fixed; width: 100%;">
    <tbody>
      
      <tr> 
         <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                     <td style="width:22%; border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0px;">1. Organisation Details</td>
                     
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
      <tr>
        <td style="border-width: 0px;padding: 10px 0 0 10px;">
          <table style="table-layout: fixed; width: 100%;padding: 0px 15px"> 
              <tbody>
                  <tr>
                     <td style="border-width: 0px;font-size: 15px;color: #000000;padding: 20px 0 0 15px;">Address</td>
                  </tr>
                  <tr>
                    <td style="width: 30px;border-width: 0px;font-size: 14px;color: #262626;padding: 10px 0 0 25px;line-height: 1.4"><?= $address['address1'] ?><?= $address['address2']?', '.$address['address2']:'' ?><?= ', <br> '.$address['statename_en'].', '.$address['cityname_en'] ?></td>
                  </tr>
              </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td style="border-width: 0px;padding: 20px 0 0 20px;">
          <table style="table-layout: fixed; width: 100%;padding: 0px;width: 25%; "> 
              <tbody>
                <tr>
                   <td  class="shadow-cell" style="font-size: 14px;color: #666666;padding: 12px 0 12px 15px;">Office Type: <span style="font-size: 14px;color: #262626;"><?= $appdata['appiit_officetype'] == 1? 'Main Office' : 'Branch Office' ?></span></td>
                </tr>
              </tbody>
          </table>
        </td>
      </tr>
      <tr>
         <td style="border-width: 0px;padding: 25px 0 0 25px;">
            <table style="table-layout: fixed; width: 100%;"> 
                <tbody>
                    <tr>
                      <td style="border-width: 0px;font-size: 15px;color: #000000;padding: 0 0 15px 0;">Focal Point Details</td>
                    </tr>
                    <tr>
                      <td class="shadow-cell">
                          <table style="table-layout: fixed; width: 100%;"> 
                            <tbody>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 12px 0 12px 0;">Name</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 12px 0 12px 0;"><?= $userdata['name']? $userdata['name'] : '-' ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Designation</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $userdata['desig']? $userdata['desig'] : '-'  ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Email</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $userdata['emailid']? $userdata['emailid'] : '-'  ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Mobile Number</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $userdata['mob_no']? $userdata['mob_no'] : '-'  ?></td>
                              </tr>
                            </tbody>
                        </table>
                      </td>
                    </tr>
                </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td style="border-width: 0px;padding: 25px 0 0 25px;">
            <table style="table-layout: fixed; width: 100%;"> 
                <tbody>
                    <tr>
                      <td style="border-width: 0px;font-size: 15px;color: #000000;padding: 0 0 15px 0;">General Manager Details</td>
                    </tr>
                    <tr>
                      <td class="shadow-cell">
                          <table style="table-layout: fixed; width: 100%;"> 
                            <tbody>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 12px 0 12px 0;">Name</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 12px 0 12px 0;"><?= $userdata['gmname']? $userdata['gmname'] : '-'    ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Email</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $userdata['gmaemailid']? $userdata['gmaemailid'] : '-'   ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Mobile Number</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $userdata['gmmobileno']? $userdata['gmmobileno'] : '-'   ?></td>
                              </tr>
                             
                            </tbody>
                        </table>
                      </td>
                    </tr>
                </tbody>
            </table>
         </td>
      </tr>
      <tr>
         <td style="border-width: 0px;padding: 25px 0 0 25px;">
            <table style="table-layout: fixed; width: 100%;"> 
                <tbody>
                    <tr>
                      <td style="border-width: 0px;font-size: 15px;color: #000000;padding: 0 0 15px 0;">Number of Staff</td>
                    </tr>
                    <tr>
                      <td class="shadow-cell">
                          <table style="table-layout: fixed; width: 100%;"> 
                            <tbody>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 12px 0 12px 0;">Omanis</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 12px 0 12px 0;"><?= $appdata['appiit_noofomani']? $appdata['appiit_noofomani'] : '-'    ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Expatriates</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $appdata['appiit_noofexpat']? $appdata['appiit_noofexpat'] : '-'   ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Total</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $appdata['totalemployee']? $appdata['totalemployee'] : '-'   ?></td>
                              </tr>
                              <tr>
                                <td style="width: 22%;border-width: 0px;font-size: 14px;color: #666666;padding: 0 0 12px 0;">Omani Percentage</td>
                                <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 0 0 12px 0;"><?= $appdata['omanpercentage']? $appdata['omanpercentage'].'%' : '-'   ?></td>
                              </tr>
                            </tbody>
                        </table>
                      </td>
                    </tr>
                </tbody>
            </table>
         </td>
      </tr>
    
    </tbody>
  </table>
  <!-- <pagebreak /> -->
  <!-- 2  Summary Report -->
  <table style="table-layout: fixed; width: 100%;margin-top:20px;">
    <tbody>
      <tr>
      <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                       <td style="width:20%; border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0px;">2. Summary Report</td>
                      
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
        <table style="margin-top: 20px">
          <tbody>
            <tr style="background-color: #f4f6f9;">
              <td style="width: 80%;border-width: 0px;font-size: 14px;color: #262626;padding: 15px 0;"></td>
              <td style="border-width: 0px;font-size: 14px;color: #262626;padding: 15px 0;">Status</td>
            </tr>
            <?php 
            $firstindex = 0;
            foreach($summary as $summary){ 
              $firstindex = $firstindex+1;
              ?>
            <tr>
                <td style="width: 80%;border-bottom: 1px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #262626;padding: 15px 0 15px 8px;"><?= $summary['category'] ?></td>
                <td style="border-bottom: 1px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #262626;padding: 15px 0;"><?= $summary['status'] ?></td>
            </tr>
            <?php } ?>
            
          </tbody>
        </table>
        <tr>
           <td style="padding-top: 30px;border-width: 0px;font-size: 15px;color: #000000;"><b>Comments</b></td>
        </tr>
        <tr>
           <td style="padding-top: 7px;line-height: 1.4;border-width: 0px;font-size: 14px;color: #262626;"><?= $appdata['appdt_gradingreason']? $appdata['appdt_gradingreason'] : 'Nil' ?></td>        
        </tr>
      </tbody>
  </table>
  <pagebreak />
 <!-- 3. OPAL STAR Desktop Review -->
 <table style="table-layout: fixed; width: 100%;">
    <tbody>
      <tr>
      <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                        <td style="width: 30%; border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0;">3. Desktop Review</td>
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
      <?php foreach($desktopreview as $desktop){ ?>
         <tr>
          <td style="border-width: 0px;padding: 0px 0 0 20px;page-break-inside:avoid">
            <table>
              <tbody>
                <tr style="background-color: #ffffff;">
                  <td style="width: 85%;border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0;">Date: <span style="color: #262626;font-size: 14px;border-right: 0px solid #cccccc;padding: 0px 15px"><?= $desktop['aarlappdecon'] ?> &nbsp;&nbsp;</span></td>
                  <td style="width: 15%;border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0 18px;">&nbsp;&nbsp; Status: <span style="color: #262626;font-size: 14px;"><?Php if( $desktop['aarl_status'] == 1){ echo 'Approved';}else{ echo 'Declined';} ?></span></td>
                </tr>
              </tbody>
            </table>
            <table>
              <tbody>
              <tr>
                <td style="padding: 20px 0 0 0px;border-width: 0px;font-size: 14px;color: #666666;">Comments</td>
              </tr>
              <tr>
                <td style="padding: 10px 0 0 0px;line-height: 1.4;border-width: 0px;font-size: 14px;color: #262626;"><?= $desktop['aarl_appdeccomments'] ? $desktop['aarl_appdeccomments'] :'Nil'?></td>
               </tr>
              </tbody>
            </table>
          </td>
       </tr>
       <?php } ?>
    </tbody>
  </table>
<pagebreak />
  <!--4. OPAL STAR Provider Site Audit  -->
  <table style="table-layout: fixed; width: 100%;">
    <tbody>
      <tr>
         <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                       <td style="width: 33%;border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0;">4. Site Audit</td>
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
      <?php
        $quespk = '';
        $typeofinput ='';
        $topindex = 0;
        ?>
        <?php foreach($data as $category) { 
          $topindex = $topindex+1;
          ?>
           <tr>
              <td style="border-width: 0px;page-break-inside:avoid;">
                <table>
                    <tbody>
                       <tr>
                         <td style="border-width: 0px;font-size: 15px;color: #262626;padding: 15px 0 0 12px;"><strong>4.<?= $topindex ?> <?=  $category['asarct_categorytitle_en'] ?></strong></td>
                       </tr>
                   </tbody>
                </table>
            
              <?php 
              $answerdata = \app\models\OpalsiteanswerTbl::find()
              ->select(['*'])
              ->leftJoin('appsiteauditquestionmsttmp_tbl ques','ques.appsiteauditquestionmsttmp_pk = asaad_auditquestionmst_fk')
              ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = asaqm_fileupload')
              ->leftJoin('appsiteauditreportcattmp_tbl  category','category.appsiteauditreportcattmp_pk = asaqm_appsiteauditreportcattmp_fk') 
              ->leftJoin('grademst_tbl','grademst_pk = asaad_grademst_fk')
              ->Where(['asaqm_appsiteauditreportcattmp_fk'=>$category['appsiteauditreportcattmp_pk']])
              ->orderBy('asaqm_order asc')
              ->asArray()
              ->all();
              $index = 0;
              $checkboccount = 0;
              foreach($answerdata as $alldata) { 
            ?>
            <?php if($quespk != $alldata['asaad_auditquestionmst_fk']){ 
              if( $alldata['asaqm_questiontype'] == 2 ){
                //checkbox
                $checkboccount++;
            } 
            ?>
              
                <?php $quespk = $alldata['asaad_auditquestionmst_fk'];  }?>
                <?php
                if( $alldata['asaqm_questiontype'] == 1 ){
                    $typeofinput = 'radio';
                    $answer = '';
                    if( $alldata['asaad_isselected'] == 1 ){
                      $index  = $index+1;
                      $answer = $alldata['asaad_answer_en'];
                    
                    ?>
          <tr>
            <td style="border-width: 0px;padding: 0px 0 0 20px;page-break-inside:avoid">
              <table>
                <tbody>
                   <?php if(empty($alldata['asaqm_comments'])){ ?>
                      <tr style="background-color: #ffffff;">
                        <td valign="top" style="border-bottom: 0px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0;">4.<?= $topindex ?>.<?= $index ?>.</td>
                        <td valign="top" style="line-height: 1.4;width: 77%;border-bottom: 0px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0;text-align: left;"><?= $alldata['asaqm_question_en']?></td>
                        <td valign="top" style="width: 18%;border-bottom: 0px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0 18px;">Status: <span style="color: #262626;font-size: 14px;"><?= $answer ?></span></td>
                      </tr>
                    <?php }else{ ?>
                      <tr style="background-color: #ffffff;">
                        <td valign="top" style="border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0;">4.<?= $topindex ?>.<?= $index ?>.</td>
                        <td valign="top" style="line-height: 1.4;width: 77%;border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0;text-align: left;"><?= $alldata['asaqm_question_en']?></td>
                        <td valign="top" style="width: 18%;border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 22px 0 15px 0 18px;">Status: <span style="color: #262626;font-size: 14px;"><?= $answer ?></span></td>
                      </tr>
                   <?php } ?>
                </tbody>
              </table>
              <?php if(!empty($alldata['asaqm_comments'])){ ?>
                <table>
                  <tbody>
                    <tr>
                       <td style="padding: 20px 0 0 0px;border-width: 0px;font-size: 14px;color: #666666;">Comments</td>
                    </tr>
                    <tr>
                       <td style="padding: 10px 0 0 0px;line-height: 1.4;border-width: 0px;font-size: 14px;color: #262626;"><?= $alldata['asaqm_comments']?$alldata['asaqm_comments']:'Nil' ?></td>
                    </tr>
                  </tbody>
                </table>
              <?php } ?>
            </td>
          </tr>
         <?php }}elseif($alldata['asaqm_questiontype'] == 2 &&  !empty($alldata['asaad_grademst_fk'])){  
            $typeofinput = 'checkbox';
            $checkanswer = '';
            if( !empty($alldata['asaad_grademst_fk']) ){
              $index = $index+1;
              $checkanswer = $alldata['gm_gradename_en'];
          ?> 
          <tr>
          <td style="border-width: 0px;padding: 0px 0 0 20px;page-break-inside:avoid">
            <table>
              <tbody>
                 <?php if(empty($alldata['asaqm_comments'])){ ?>
                  <tr style="background-color: #ffffff;">
                     <td style="width: 82%;border-bottom: 0px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0;">4.<?= $topindex ?>.<?= $index ?>. <?= $alldata['asaqm_question_en']?></td>
                     <td style="border-bottom: 0px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0 18px;">Grade:  <span style="color: #262626;font-size: 14px;"><?php echo  $checkanswer; ?> </span></td>
                  </tr>
                <?php }else{ ?>
                  <tr style="background-color: #ffffff;">
                    <td style="width: 82%;border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0;">4.<?= $topindex ?>.<?= $index ?>. <?= $alldata['asaqm_question_en']?></td>
                     <td style="border-bottom: 2px solid #f4f6f9;border-top: 0px;border-left: 0px;border-right: 0px;font-size: 14px;color: #666666;padding: 30px 0 15px 0 18px;">Grade:  <span style="color: #262626;font-size: 14px;"><?php echo  $checkanswer; ?> </span></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php if(!empty($alldata['asaqm_comments'])){ ?>
              <table>
                <tbody>
                    <tr>
                      <td style="padding: 20px 0 0 0px;border-width: 0px;font-size: 14px;color: #666666;">Comments</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px 0 0 0px;line-height: 1.4;border-width: 0px;font-size: 14px;color: #262626;"><?= $alldata['asaqm_comments']?$alldata['asaqm_comments']:'Nil' ?></td>
                    </tr>
                </tbody>
              </table>
            <?php } ?>
          </td>
       </tr>
            <?php }}?>
            <?php 
                $checked ='';
                if( $alldata['asaad_isselected'] == 1 ){
                    $checked = 'checked="checked"';
                }else{
                    $checked ='';
                }
            ?>
            <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>


<!--5. Declarations -->
<?php if(!empty($siteauditor)){ ?>
  <!-- <pagebreak /> -->
<table style="table-layout: fixed; width: 100%;page-break-inside:avoid;">
    <tbody>
      <tr>
      <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                       <td style="width: 16%; border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0;">5. Declarations</td>
                       
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
        <tr>
            <td style="border-width: 0px;">
                <table style= "margin-left: 20px;"> 
                     <tbody>
                     <tr>
                          <td style="padding: 15px 0 0 0px;border-width: 0px;font-size: 14px;color: #666666;">Signatures</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 0 0px 0px;line-height: 1.4;border-width: 0px;font-size: 14px;color: #262626;">I declare that at all times, the OPAL Road Safety Standard procedure was followed and that decisions made about the standard of documentation provided was against the standard OPAL-STD-HSE--01 Rev 2.</td>
                        </tr>
                     </tbody>
                </table>
            </td>
        </tr>
         <table style="padding-top: 20px;margin: 20px 0 20px 20px;">
            <tbody>   
            <tr class="shadow-cell">
                <td style="border-width: 0px;">
                  <table >
                      <tbody>
                        <tr style="background-color: #ffffff;">
                          <td valign="top" style="width: 5px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Name: </td>
                          <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $siteauditor['oum_firstname']? $siteauditor['oum_firstname']:'Nil' ?> <br><span style="color:#262626;font-size: 12px;">(Quality Auditor)</span></td>
                        </tr>
                      </tbody>
                    </table> 
                </td>
                  <td style="border-width: 0px;width: 25%;">
                    <table >
                        <tbody>
                          <tr style="background-color: #ffffff;">
                            <td valign="top" style="width: 7px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Date: </td>
                            <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $siteauditor['aarlappdecon']?$siteauditor['aarlappdecon']:'Nil' ?></td>
                          </tr>
                        </tbody>
                      </table> 
                  </td>
              </tr>
            </tbody>
         </table>
    </tbody>
</table>
<?php } ?>
<!--6. Approvals -->
<?php if(!empty($qualitimanager)){ ?>
<table style="table-layout: fixed; width: 100%;page-break-inside:avoid;">
    <tbody>
      <tr>
        <td style="border-width: 0px;">
             <table>
                 <tbody>
                     <tr>
                        <td style="width: 16%;border-width: 0px;font-size: 17px;color: #0c4b9a;padding: 0;">6. Approvals</td>
                        
                     </tr>
                 </tbody>
             </table>
         </td>
      </tr>
         <table style="margin: 10px 0px 10px 20px;">
            <tbody>   
              <tr class="shadow-cell">
                <td style="border-width: 0px;">
                  <table >
                      <tbody>
                        <tr style="background-color: #ffffff;">
                          <td valign="top" style="width: 105px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Reviewed by: </td>
                          <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $qualitimanager['oum_firstname']? $qualitimanager['oum_firstname']:'Nil' ?> <br><span style="color:#262626;font-size: 12px;">(Quality Manager)</span></td>
                        </tr>
                      </tbody>
                    </table> 
                </td>
                  <td style="border-width: 0px;width: 25%;">
                    <table >
                        <tbody>
                          <tr style="background-color: #ffffff;">
                            <td style="width: 7px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Date: </td>
                            <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $qualitimanager['aarlappdecon']?$qualitimanager['aarlappdecon']:'Nil' ?></td>
                          </tr>
                        </tbody>
                      </table> 
                  </td>
              </tr>
            </tbody>
         </table>
         <?php if(!empty($authoriy)){ ?>
         <table style="margin: 10px 0px 10px 20px;">
            <tbody>   
              <tr class="shadow-cell">
                <td style="border-width: 0px;">
                  <table >
                      <tbody>
                        <tr style="background-color: #ffffff;">
                          <td valign="top" style="width: 105px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Validated by: </td>
                          <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $authoriy['oum_firstname']? $authoriy['oum_firstname']:'Nil' ?> <br><span style="color:#262626;font-size: 12px;">(GM. Quality & Accreditation)</span></td>
                        </tr>
                      </tbody>
                    </table> 
                </td>
                  <td style="border-width: 0px;width: 25%;">
                    <table >
                        <tbody>
                          <tr style="background-color: #ffffff;">
                            <td valign="top" style="width: 7px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Date: </td>
                            <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $authoriy['aarlappdecon']?$authoriy['aarlappdecon']:'Nil' ?></td>
                          </tr>
                        </tbody>
                      </table> 
                  </td>
              </tr>
            </tbody>
         </table>
         <?php } ?>
         <?php if(!empty($ceo)){ ?>
         <table style="margin: 10px 0px 10px 20px;">
            <tbody>   
              <tr class="shadow-cell">
                <td style="border-width: 0px;">
                  <table >
                      <tbody>
                        <tr style="background-color: #ffffff;">
                          <td valign="top" style="width: 105px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Approved by: </td>
                          <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $ceo['oum_firstname']? $ceo['oum_firstname']:'Nil' ?> <br><span style="color:#262626;font-size: 12px;">(OPAL CEO)</span></td>
                        </tr>
                      </tbody>
                    </table> 
                </td>
                  <td style="border-width: 0px;width: 25%;">
                    <table >
                        <tbody>
                          <tr style="background-color: #ffffff;">
                            <td valign="top" style="width: 7px;padding: 15px 0 15px 20px;border-width: 0px;font-size: 14px;color: #666666;">Date: </td>
                            <td style="padding: 15px 0 15px 10px;border-width: 0px;font-size: 14px;color: #262626;"><?= $ceo['aarlappdecon']?$ceo['aarlappdecon']:'Nil' ?></td>
                          </tr>
                        </tbody>
                      </table> 
                  </td>
              </tr>
            </tbody>
         </table>
         <?php } ?>
    </tbody>
</table>
</div> 
<?php } ?>
 