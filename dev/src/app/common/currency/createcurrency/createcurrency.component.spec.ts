import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatecurrencyComponent } from './createcurrency.component';

describe('CreatecurrencyComponent', () => {
  let component: CreatecurrencyComponent;
  let fixture: ComponentFixture<CreatecurrencyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CreatecurrencyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CreatecurrencyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
