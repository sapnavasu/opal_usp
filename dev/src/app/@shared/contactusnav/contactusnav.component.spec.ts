import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ContactusnavComponent } from './contactusnav.component';

describe('ContactusnavComponent', () => {
  let component: ContactusnavComponent;
  let fixture: ComponentFixture<ContactusnavComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ContactusnavComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ContactusnavComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
