import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MasterdatadashboardComponent } from './masterdatadashboard.component';

describe('MasterdatadashboardComponent', () => {
  let component: MasterdatadashboardComponent;
  let fixture: ComponentFixture<MasterdatadashboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MasterdatadashboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MasterdatadashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
