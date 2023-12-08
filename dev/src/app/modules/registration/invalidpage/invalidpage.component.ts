import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Encrypt } from '@app/common/class/encrypt';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-invalidpage',
  templateUrl: './invalidpage.component.html',
  styleUrls: ['./invalidpage.component.scss']
})
export class InvalidpageComponent implements OnInit {
  invalidType: string;
  emailID: string;
  constructor(private route: ActivatedRoute, private security: Encrypt) { }

  ngOnInit() {
    this.route.queryParams.subscribe(data => {
      this.invalidType = data['type'];
      this.emailID = this.security.decrypt(data['m']); //mail
    });
  }

}
