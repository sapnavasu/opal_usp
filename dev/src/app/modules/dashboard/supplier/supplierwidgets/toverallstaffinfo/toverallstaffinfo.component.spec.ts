import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ToverallstaffinfoComponent } from './toverallstaffinfo.component';

describe('ToverallstaffinfoComponent', () => {
  let component: ToverallstaffinfoComponent;
  let fixture: ComponentFixture<ToverallstaffinfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ToverallstaffinfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ToverallstaffinfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
