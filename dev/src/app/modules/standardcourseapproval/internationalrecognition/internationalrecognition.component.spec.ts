import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { InternationalrecognitionComponent } from './internationalrecognition.component';

describe('InternationalrecognitionComponent', () => {
  let component: InternationalrecognitionComponent;
  let fixture: ComponentFixture<InternationalrecognitionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ InternationalrecognitionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(InternationalrecognitionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
