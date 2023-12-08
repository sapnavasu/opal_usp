import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FactorauthenticationComponent } from './factorauthentication.component';

describe('FactorauthenticationComponent', () => {
  let component: FactorauthenticationComponent;
  let fixture: ComponentFixture<FactorauthenticationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FactorauthenticationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FactorauthenticationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
