import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BgimapComponent } from './bgimap.component';

describe('BgimapComponent', () => {
  let component: BgimapComponent;
  let fixture: ComponentFixture<BgimapComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BgimapComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BgimapComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
