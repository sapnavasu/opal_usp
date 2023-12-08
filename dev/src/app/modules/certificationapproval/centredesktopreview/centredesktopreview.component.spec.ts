import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CentredesktopreviewComponent } from './centredesktopreview.component';

describe('CentredesktopreviewComponent', () => {
  let component: CentredesktopreviewComponent;
  let fixture: ComponentFixture<CentredesktopreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CentredesktopreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CentredesktopreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
