import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PendinglistaccordionComponent } from './pendinglistaccordion.component';

describe('PendinglistaccordionComponent', () => {
  let component: PendinglistaccordionComponent;
  let fixture: ComponentFixture<PendinglistaccordionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PendinglistaccordionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PendinglistaccordionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
