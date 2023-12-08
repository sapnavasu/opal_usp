import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ApprovescsiteauditComponent } from './approvescsiteaudit.component';

describe('ApprovescsiteauditComponent', () => {
  let component: ApprovescsiteauditComponent;
  let fixture: ComponentFixture<ApprovescsiteauditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ApprovescsiteauditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ApprovescsiteauditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
