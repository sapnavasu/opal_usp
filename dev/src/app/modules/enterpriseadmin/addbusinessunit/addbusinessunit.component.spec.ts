import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddbusinessunitComponent } from './addbusinessunit.component';

describe('AddbusinessunitComponent', () => {
  let component: AddbusinessunitComponent;
  let fixture: ComponentFixture<AddbusinessunitComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddbusinessunitComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddbusinessunitComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
