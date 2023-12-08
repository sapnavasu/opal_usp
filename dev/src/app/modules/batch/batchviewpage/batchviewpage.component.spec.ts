import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BatchviewpageComponent } from './batchviewpage.component';

describe('BatchviewpageComponent', () => {
  let component: BatchviewpageComponent;
  let fixture: ComponentFixture<BatchviewpageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BatchviewpageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BatchviewpageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
