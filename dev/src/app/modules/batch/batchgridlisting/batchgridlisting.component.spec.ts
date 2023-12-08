import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BatchgridlistingComponent } from './batchgridlisting.component';

describe('BatchgridlistingComponent', () => {
  let component: BatchgridlistingComponent;
  let fixture: ComponentFixture<BatchgridlistingComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BatchgridlistingComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BatchgridlistingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
