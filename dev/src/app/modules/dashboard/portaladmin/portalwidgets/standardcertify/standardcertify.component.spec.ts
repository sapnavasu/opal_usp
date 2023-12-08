import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { StandardcertifyComponent } from './standardcertify.component';

describe('StandardcertifyComponent', () => {
  let component: StandardcertifyComponent;
  let fixture: ComponentFixture<StandardcertifyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ StandardcertifyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(StandardcertifyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
