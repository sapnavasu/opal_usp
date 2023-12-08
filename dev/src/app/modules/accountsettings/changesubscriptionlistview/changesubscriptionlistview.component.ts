import { Component, OnInit, Input } from '@angular/core';
import swal from 'sweetalert';
import { ViewEncapsulation } from '@angular/core';
import { MatDrawer } from '@angular/material/sidenav';
import { ToastrService } from 'ngx-toastr'
@Component({
  selector: 'app-changesubscriptionlistview',
  templateUrl: './changesubscriptionlistview.component.html',
  styleUrls: ['./changesubscriptionlistview.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class ChangesubscriptionlistviewComponent implements OnInit {
  public buttonname: string = 'Update';
  @Input('changesubscriptiondrawer') changesubscriptiondrawer: MatDrawer;
  animationState1 = 'out';
  constructor(public toastr: ToastrService) { }

  ngOnInit() {
  }
  changesubscriptionlist(divName: string) {
    if (divName === 'changesubscriptionlisted') {
      this.animationState1 = this.animationState1 === 'out' ? 'in' : 'out';
    }
  }
  changesubscriptionAlert() {
    swal({
      title: "Do you want to cancel creating this Change Subscription",
      text: 'Are you sure you want to cancel? If yes all the data will be lost',
      icon: 'warning',
      closeOnClickOutside: false,
      closeOnEsc: false,
      buttons: ['Cancel', 'Ok'],
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        this.changesubscriptiondrawer.toggle();
        this.showSuccess();
      }
    });
    this.animationState1 = 'out';
  }
  showSuccess() {
    this.toastr.success('everything is broken', 'Success !', {
      timeOut: 3000,
      closeButton: true,
    });
  }
}
