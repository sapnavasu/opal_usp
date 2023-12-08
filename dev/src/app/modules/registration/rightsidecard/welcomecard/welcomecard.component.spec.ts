import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { WelcomecardComponent } from './welcomecard.component';

describe('WelcomecardComponent', () => {
  let component: WelcomecardComponent;
  let fixture: ComponentFixture<WelcomecardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ WelcomecardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(WelcomecardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
