import { Component, OnInit, ViewChild, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { UserdetailsComponent } from './userreg/userreg.component';
import { Encrypt } from '@app/common/class/encrypt';
import { ProfileService } from '@app/modules/profilemanagement/profile.service';
import { MatTabGroup } from '@angular/material/tabs';

@Component({
  selector: 'app-regsitration',
  templateUrl: './regsitration.component.html',
  styleUrls: ['./regsitration.component.scss']
})
export class RegsitrationComponent implements OnInit {

  @ViewChild('tabGroup') tabGroup: MatTabGroup; 
  @ViewChild('userreg') userreg: UserdetailsComponent;
  invalidType: string;

  constructor(private routerID: ActivatedRoute,
    private router: Router,
    private security: Encrypt,
    private profileService: ProfileService) {}
  
  ngOnInit() {
    this.logOut();
    this.setDefaultValues(this.routerID);
  }

  logOut() {
    if (localStorage.getItem('v3logindata') !== null) {
      this.profileService.logout().subscribe(data => {
        localStorage.removeItem('v3logindata');
      })
    }
  }

  setDefaultValues(route: ActivatedRoute){
    route.queryParams.subscribe(data => {
      this.tabGroup.selectedIndex = Number(this.security.decrypt(data.type)) - 1;
      this.userreg.userinvitepk = data.pk;
    });
  }

  routeTo(event){
    this.invalidType = event;
    this.router.navigate(['registration/invalidpage'], { state: { invalidType: event } });
  }

}