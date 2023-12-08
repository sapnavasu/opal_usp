import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TwofactorauthComponent } from './twofactorauth.component';

describe('TwofactorauthComponent', () => {
  let component: TwofactorauthComponent;
  let fixture: ComponentFixture<TwofactorauthComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TwofactorauthComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TwofactorauthComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
