import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FinalgradeComponent } from './finalgrade.component';

describe('FinalgradeComponent', () => {
  let component: FinalgradeComponent;
  let fixture: ComponentFixture<FinalgradeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FinalgradeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FinalgradeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
