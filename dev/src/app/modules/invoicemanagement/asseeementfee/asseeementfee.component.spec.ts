import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AsseeementfeeComponent } from './asseeementfee.component';

describe('AsseeementfeeComponent', () => {
  let component: AsseeementfeeComponent;
  let fixture: ComponentFixture<AsseeementfeeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AsseeementfeeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AsseeementfeeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
