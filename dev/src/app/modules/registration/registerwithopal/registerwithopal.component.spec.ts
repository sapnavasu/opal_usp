import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { registerwithopalComponent } from './registerwithopal.component';

describe('registerwithopalComponent', () => {
  let component: registerwithopalComponent;
  let fixture: ComponentFixture<registerwithopalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ registerwithopalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(registerwithopalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
