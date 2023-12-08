import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TemporaryaudittrailComponent } from './temporaryaudittrail.component';

describe('TemporaryaudittrailComponent', () => {
  let component: TemporaryaudittrailComponent;
  let fixture: ComponentFixture<TemporaryaudittrailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TemporaryaudittrailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TemporaryaudittrailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
