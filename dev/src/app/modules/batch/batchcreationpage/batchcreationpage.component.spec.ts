import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BatchcreationpageComponent } from './batchcreationpage.component';

describe('BatchcreationpageComponent', () => {
  let component: BatchcreationpageComponent;
  let fixture: ComponentFixture<BatchcreationpageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BatchcreationpageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BatchcreationpageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
