import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ChangeclassifylistviewComponent } from './changeclassifylistview.component';

describe('ChangeclassifylistviewComponent', () => {
  let component: ChangeclassifylistviewComponent;
  let fixture: ComponentFixture<ChangeclassifylistviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ChangeclassifylistviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ChangeclassifylistviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
