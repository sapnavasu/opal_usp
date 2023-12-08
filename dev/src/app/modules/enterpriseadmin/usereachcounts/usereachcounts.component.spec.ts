import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UsereachcountsComponent } from './usereachcounts.component';

describe('UsereachcountsComponent', () => {
  let component: UsereachcountsComponent;
  let fixture: ComponentFixture<UsereachcountsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UsereachcountsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UsereachcountsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
