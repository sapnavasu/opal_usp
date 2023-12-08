import { Component, Inject, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-commoncomments',
  templateUrl: './commoncomments.component.html',
  styleUrls: ['./commoncomments.component.scss']
})
export class CommoncommentsComponent implements OnInit {

  constructor(public dialogRef: MatDialogRef<CommoncommentsComponent>, @Inject(MAT_DIALOG_DATA) public data: any, private router: Router) { }


  ngOnInit(): void {
  }
  closedialog(): void {
    this.dialogRef.close();
  }
}
