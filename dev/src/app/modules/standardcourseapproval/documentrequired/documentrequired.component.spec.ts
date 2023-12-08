import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocumentrequiredComponent } from './documentrequired.component';

describe('DocumentrequiredComponent', () => {
  let component: DocumentrequiredComponent;
  let fixture: ComponentFixture<DocumentrequiredComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocumentrequiredComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocumentrequiredComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
