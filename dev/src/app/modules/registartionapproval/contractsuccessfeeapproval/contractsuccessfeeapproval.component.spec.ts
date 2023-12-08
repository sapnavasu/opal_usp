/* tslint:disable:no-unused-variable */
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { By } from '@angular/platform-browser';
import { DebugElement } from '@angular/core';

import { ContractsuccessfeeapprovalComponent } from './contractsuccessfeeapproval.component';

describe('ContractsuccessfeeapprovalComponent', () => {
  let component: ContractsuccessfeeapprovalComponent;
  let fixture: ComponentFixture<ContractsuccessfeeapprovalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ContractsuccessfeeapprovalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ContractsuccessfeeapprovalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
