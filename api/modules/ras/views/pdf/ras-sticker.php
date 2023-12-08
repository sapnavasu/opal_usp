<!DOCTYPE html>
<html>
<body>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Vehicle Registration</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['rvrd_vechicleregno'] ?></div>
    </div>    
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Name of the User</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= substr($userdata['owner_en'],0,35) ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Inspection Date</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['dateofinspetcion'] ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Next Inspection Date</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['nextinspeciondate'] ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">RASIC Number</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['rvrd_applicationrefno'] ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Inspection Company</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?=  substr($userdata['companyname'],0,35) ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Name of Inspector</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= substr($userdata['name'],0,35) ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Verification Number</div>
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['varificationnumber'] ?></div>
    </div>
    <div style="margin-bottom:2px; width:100%">
        <div style="width:105px;float:left; text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;">Vehicle Approval</div> 
        <div nowrap style="white-space: nowrap;margin-left:3px;width:200px;float:left;text-align: left;font-size: 7pt;color:#231F20;font-weight:bold;border:1px solid #414042;border-radius:1px;padding:4px 3px;"><?= $userdata['roadtype_en'] ?></div>
    </div>
    </div>
    <div style="float:left;width:320px;margin-top:5px">
        <?php echo $comlogo ?>
        <?php echo $qrcode ?>
    </div>
</body>

</html>