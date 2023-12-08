import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { IvmspendinglistaccordionComponent } from './ivmspendinglistaccordion.component';

describe('IvmspendinglistaccordionComponent', () => {
  let component: IvmspendinglistaccordionComponent;
  let fixture: ComponentFixture<IvmspendinglistaccordionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ IvmspendinglistaccordionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(IvmspendinglistaccordionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
