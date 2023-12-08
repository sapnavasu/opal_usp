import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BatchmanagmentComponent } from './batchmanagment.component';

describe('BatchmanagmentComponent', () => {
  let component: BatchmanagmentComponent;
  let fixture: ComponentFixture<BatchmanagmentComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BatchmanagmentComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BatchmanagmentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
