import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AssessoravailabilityComponent } from './assessoravailability.component';

describe('AssessoravailabilityComponent', () => {
  let component: AssessoravailabilityComponent;
  let fixture: ComponentFixture<AssessoravailabilityComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AssessoravailabilityComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AssessoravailabilityComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
