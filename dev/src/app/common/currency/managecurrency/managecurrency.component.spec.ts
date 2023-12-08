import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagecurrencyComponent } from './managecurrency.component';

describe('ManagecurrencyComponent', () => {
  let component: ManagecurrencyComponent;
  let fixture: ComponentFixture<ManagecurrencyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ManagecurrencyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ManagecurrencyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
