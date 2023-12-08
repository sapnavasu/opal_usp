import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RegisterationconfirmedComponent } from './registerationconfirmed.component';

describe('RegisterationconfirmedComponent', () => {
  let component: RegisterationconfirmedComponent;
  let fixture: ComponentFixture<RegisterationconfirmedComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RegisterationconfirmedComponent ]
    })
    .compileComponents();
  }));   

  beforeEach(() => {
    fixture = TestBed.createComponent(RegisterationconfirmedComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
