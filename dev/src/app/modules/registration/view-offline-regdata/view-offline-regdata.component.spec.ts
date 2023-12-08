import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewOfflineRegdataComponent } from './view-offline-regdata.component';

describe('ViewOfflineRegdataComponent', () => {
  let component: ViewOfflineRegdataComponent;
  let fixture: ComponentFixture<ViewOfflineRegdataComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewOfflineRegdataComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewOfflineRegdataComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
