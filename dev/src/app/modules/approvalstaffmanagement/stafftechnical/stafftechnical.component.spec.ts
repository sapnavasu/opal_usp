import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StafftechnicalComponent } from './stafftechnical.component';

describe('StafftechnicalComponent', () => {
  let component: StafftechnicalComponent;
  let fixture: ComponentFixture<StafftechnicalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StafftechnicalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StafftechnicalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
