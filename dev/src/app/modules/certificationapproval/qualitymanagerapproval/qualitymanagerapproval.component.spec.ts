import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { QualitymanagerapprovalComponent } from './qualitymanagerapproval.component';

describe('QualitymanagerapprovalComponent', () => {
  let component: QualitymanagerapprovalComponent;
  let fixture: ComponentFixture<QualitymanagerapprovalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ QualitymanagerapprovalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(QualitymanagerapprovalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
