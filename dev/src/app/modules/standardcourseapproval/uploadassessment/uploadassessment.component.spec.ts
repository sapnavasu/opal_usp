import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UploadassessmentComponent } from './uploadassessment.component';

describe('UploadassessmentComponent', () => {
  let component: UploadassessmentComponent;
  let fixture: ComponentFixture<UploadassessmentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UploadassessmentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UploadassessmentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
