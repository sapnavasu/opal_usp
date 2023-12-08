import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MapcommunicateaddresslistComponent } from './mapcommunicateaddresslist.component';

describe('MapcommunicateaddresslistComponent', () => {
  let component: MapcommunicateaddresslistComponent;
  let fixture: ComponentFixture<MapcommunicateaddresslistComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MapcommunicateaddresslistComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MapcommunicateaddresslistComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
