import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ContactinfonewComponent } from './contactinfonew.component';

describe('ContactinfonewComponent', () => {
  let component: ContactinfonewComponent;
  let fixture: ComponentFixture<ContactinfonewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ContactinfonewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ContactinfonewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
