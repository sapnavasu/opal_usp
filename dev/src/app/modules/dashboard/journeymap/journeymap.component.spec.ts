import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { JourneymapComponent } from './journeymap.component';

describe('JourneymapComponent', () => {
  let component: JourneymapComponent;
  let fixture: ComponentFixture<JourneymapComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ JourneymapComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(JourneymapComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
