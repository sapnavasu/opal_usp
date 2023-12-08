<html>

<head>
    <style>
        .text {
            color: #848484;
        }

        .subtext {
            color: #262626;
        }

        /* .minwidth {
            padding-right: 30px;
        }
        .minwidthtwo {
            padding-right: 56px;
        } */

        #stafcv .user {
            background-color: #F6FAFF;
            color: #262626;
        }

        #stafcv .user h4 {
            font-size: 20px;
            color: #262626;

        }

        #stafcv .user .contactinfo {
            display: flex;
            padding-left: 20px;

        }

        .contactinfo .border {
            border-left: 3px solid #0C4B9A;
        }



        #stafcv .user .contactinfo .contdetails {
            margin-left: 25px;

        }

        /* #stafcv .userinfo {
            background-color: rgba(255, 255, 255, 0.97);
            background-blend-mode: lighten;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 100%;
        } */

        #stafcv .userinfo .persolnal-info .box {
            border: 1px solid #D7DCE3;
        }

        #stafcv .userinfo .persolnal-info .box .boxhead {
            border-bottom: 1px solid #D7DCE3;
        }
    </style>
</head>
<div id="stafcv">
    
    <div class="userinfo" style="background-image: url(assets/images/opalimages/opal-logo.svg);padding: 20px">
        <div class="persolnal-info ">
            <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin-bottom: 10px;">Personal Information</h4>
            <table class="contdetails fs-14 " style="padding-left: 20px;width:  100%;">
            <colgroup>
                <col style="width: 30%;">
                <col style="width: 70%;">
            </colgroup>
                <tr>
                    <td class="minwidth" width=30% style="color: #848484;font-size: 16px;width:30%;">Date of Birth </td>
                    <td class="details" style="color: #262626;font-size: 16px;"><?= date("d-m-Y", strtotime($stfRepo['sir_dob'])) ?></td>
                </tr>
                <tr> 
                    <td class="minwidth" width=30%  style="padding-top: 15px;color: #848484;font-size: 16px;width:30%;">Age</td>
                    <td class="details" style="padding-top: 15px;color: #262626;font-size: 16px;"><?= (date('Y') - date('Y', strtotime($stfRepo['sir_dob']))) ?></td>
                 </tr>
                <tr>
                    <td class="minwidth" width=30%  style="padding-top: 15px;color: #848484;font-size: 16px;width:30%;">Gender</td>
                    <td class="details" style="padding-top: 15px;color: #262626;font-size: 16px;"><?= $stfRepo['sir_gender'] == 1 ? "Male" : "Female"; ?></td>
                </tr>
                <tr>
                    <td class="minwidth" width=30%  style="padding-top: 15px;color: #848484;font-size: 16px;width:30%;">Nationality</td>
                   <!-- <td class="minwidth" width=30%  style="color: #848484;font-size: 16px;width:30%;">Nationality<td> -->
                    <td class="details" style="padding-top: 15px;color: #262626;font-size: 16px;"><?= app\models\OpalcountrymstTbl::findOne($stfRepo['sir_nationality'])->ocym_countryname_en; ?></td>
                </tr>
                <tr> 
                    <td class="minwidth" width=30% style="padding-top: 15px;color: #848484;font-size: 16px;width:30%;text-transform:capitalize;">Permanant Residence</td>
                    <td class="details" style="padding-top: 15px;color: #262626;font-size: 16px;"><?= !empty($stfRepo['sir_addrline1']) ? $stfRepo['sir_addrline1']."," : ""; ?>  <?= !empty($stfRepo['sir_addrline2']) ? $stfRepo['sir_addrline2']."," : ""; ?>  <?= app\models\OpalcitymstTbl::findOne($stfRepo['sir_opalcitymst_fk'])->ocim_cityname_en; ?>, <?= app\models\OpalstatemstTbl::findOne($stfRepo['sir_opalstatemst_fk'])->osm_statename_en; ?></td>
                </tr>
            </table>

        </div>
        <div class="persolnal-info ">
            <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 700;margin-bottom: 10px;">Educational Qualification</h4>
            <?php if (!empty($stfEdu)) { ?>
                <?php foreach ($stfEdu as $stfDtls) { ?>
                    <div style="padding-left: 0px;margin-top:15px;page-break-inside:avoid">
                        <div class="box pd-0 m-10" style="border: 1px solid #D7DCE3;border-radius: 2px;padding-left:0px;">
                            <div class="boxhead pd-10" style="border-bottom: 1px solid #D7DCE3;padding-left:20px;">
                                <h4 class="fs-16 m-0" style="font-size:18px;font-weight: 600;"><?= $stfDtls['sacd_institutename'] ?></h4>
                                <!-- <p class="fs-14 m-0"><?= date("d-m-Y", strtotime($stfDtls['sacd_startdate'])) ?> to <?= date("d-m-Y", strtotime($stfDtls['sacd_enddate'])) ?></p> -->
                            </div>
                            <div class="boxbody" style="padding-left:20px;padding-top:10px;padding-bottom: 10px;">
                                <div class="contactinfo d-flex">
                                    <table class="contdetails-left fs-14 p-l-10 m-r-40 text" style="width: 100%;">

                                        <!-- <p> <span class="minwidth" style="color: #848484;font-size: 16px;min-width: 200px;">Location</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="details" style="color: #262626;font-size: 16px;"><?= app\models\OpalcitymstTbl::findOne($stfDtls['sacd_opalcitymst_fk'])->ocim_cityname_en; ?> , <?= app\models\OpalstatemstTbl::findOne($stfDtls['sacd_opalstatemst_fk'])->osm_statename_en; ?></span>
                                        </p> -->
                                        <colgroup>
                                            <col style="width: 30%;">
                                            <col style="width: 70%;">
                                        </colgroup>
                                        <tr>
                                            <td class="minwidth" width=30% style="color: #848484;font-size: 16px;width:30%;">Graduation Date</td>
                                            <td class="details" style="color: #262626;font-size: 16px;"><?= date("d-m-Y", strtotime($stfDtls['sacd_enddate'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="minwidth" width=30% style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">Educational Level</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['rm_name_en']; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="minwidth" width=30% style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">Certificate Title</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['sacd_degorcert'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="minwidth" width=30% style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">GPA/Grade</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['sacd_grade'] ?></td>
                                        </tr>
                                        <!-- <tr> 
                                            <td class="minwidthtwo" width="40%" style="color: #848484;font-size: 16px;width: 50%;padding-top: 15px;">Graduation Date</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= date("d-m-Y", strtotime($stfDtls['sacd_enddate'])) ?></td>
                                        </tr>
                                        <tr> 
                                            <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 40%;padding-top: 15px;">Educational Level</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['rm_name_en']; ?></td>
                                        </tr>
                                        <tr> 
                                            <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 40%;padding-top: 15px;">Certificate Title</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['sacd_degorcert'] ?></td>
                                        </tr>
                                        <tr> <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 40%;padding-top: 15px;">GPA/Grade</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfDtls['sacd_grade'] ?></td>
                                        </tr> -->
                                        <!-- <tr>
                                             <td class="minwidth" style="color: #848484;font-size: 16px;width: 30%;padding-top: 15px;">Uploaded Certificate</td>
                                            <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><img src="assets/images/opalimages/pdf_new.png" alt="uploaddocument"></td>
                                        </tr> -->
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            <?php } else { ?>
                <div class="box pd-0 m-10" style="padding:20px;">
                    Nil
                </div>
            <?php } ?>
        </div>
        <div class="persolnal-info " border: 1px solid #D7DCE3;border-radius: 2px;padding:10px;>
            <h4 class="fs-18 m-0" style="font-size:20px;font-weight: 600;">Work Experience</h4>
            <?php if (!empty($stfWork)) { ?>
                <?php foreach ($stfWork as $stfWorkDtls) { ?>
                    <div style="padding-left:0px;margin-top:20px;page-break-inside:avoid">
                        <div class="box pd-0 m-10" style="border: 1px solid #D7DCE3;border-radius: 2px;padding-left:0px;">
                            <div class="boxhead pd-10" style="border-bottom: 1px solid #D7DCE3;padding-left:20px;padding-bottom:10px;">
                                <h4 class="fs-16 m-0" style="font-size:18px;font-weight: 600;margin-bottom: 10px;"><?= $stfWorkDtls['sexp_employername'] ?></h4>
                                <span class="minwidth" style="color: #848484;font-size: 16px;min-width: 200px;padding-bottom:10px;">Location:<span><span style="color: #242422;margin-bottom:15px;"><?php if($stfWorkDtls['sexp_opalcitymst_fk']) {?>
                                                    <?= app\models\OpalcitymstTbl::findOne($stfWorkDtls['sexp_opalcitymst_fk'])->ocim_cityname_en; ?>, 
                                                    <?php } ?>
                                                    <?php if($stfWorkDtls['sexp_opalstatemst_fk']) {?>   
                                                    <?= app\models\OpalstatemstTbl::findOne($stfWorkDtls['sexp_opalstatemst_fk'])->osm_statename_en; ?>, 
                                                    <?php } ?>
                                                    <?php if($stfWorkDtls['sexp_opalcountrymst_fk']) {?>   
                                                    <?= app\models\OpalcountrymstTbl::findOne($stfWorkDtls['sexp_opalcountrymst_fk'])->ocym_countryname_en; ?>
                                                    <?php } ?></span>
            
                            </div>
                            <div class="boxbody" style="padding-left:20px;padding-bottom: 15px;">
                                <table class="contactinfo d-flex" style="width: 100%">
                                <colgroup>
                                    <col style="width: 30%;">
                                    <col style="width: 70%;">
                                </colgroup>
                                    <tr> 
                                       
                                    <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 30%;padding-top: 15px;">Job Title</td>
                                        <!-- <td class="minwidth" style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">Job Title<td> -->
                                        <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfWorkDtls['sexp_designation'] ?></td></tr>
                                    <tr> 
                                     <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 30%;padding-top: 15px;">Date of Joining</td>
                                        <!-- <td class="minwidth" style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">Date of Joining<td> -->
                                        <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfWorkDtls['sexp_doj']? date("d-m-Y", strtotime($stfWorkDtls['sexp_doj'])) :'-' ?></td>
                                    </tr>
                                                  
                                    <tr> 
                                      <td class="minwidthtwo" style="color: #848484;font-size: 16px;width: 30%;padding-top: 15px;">Worked Till</td>
                                      <!-- <td class="minwidth" style="color: #848484;font-size: 16px;width:30%;padding-top: 15px;">Worked Till<td> -->
                                       <td class="details" style="color: #262626;font-size: 16px;padding-top: 15px;"><?= $stfWorkDtls['sexp_currentlyworking'] == '1' ? "Till date" : date("d-m-Y", strtotime($stfWorkDtls['sexp_eod'])); ?></td></tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="box pd-0 m-10" style="padding-left:20px;">
                    Nil
                </div>
            <?php } ?>
        </div>
    </div>

</div>

</html>