import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ThankyoupageviewComponent } from './thankyoupageview.component';

describe('ThankyoupageviewComponent', () => {
  let component: ThankyoupageviewComponent;
  let fixture: ComponentFixture<ThankyoupageviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ThankyoupageviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ThankyoupageviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
