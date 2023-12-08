import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OverallstaffinfoComponent } from './overallstaffinfo.component';

describe('OverallstaffinfoComponent', () => {
  let component: OverallstaffinfoComponent;
  let fixture: ComponentFixture<OverallstaffinfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OverallstaffinfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OverallstaffinfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
