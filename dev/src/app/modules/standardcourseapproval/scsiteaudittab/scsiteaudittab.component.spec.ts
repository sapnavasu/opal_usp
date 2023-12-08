import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ScsiteaudittabComponent } from './scsiteaudittab.component';

describe('ScsiteaudittabComponent', () => {
  let component: ScsiteaudittabComponent;
  let fixture: ComponentFixture<ScsiteaudittabComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ScsiteaudittabComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ScsiteaudittabComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
